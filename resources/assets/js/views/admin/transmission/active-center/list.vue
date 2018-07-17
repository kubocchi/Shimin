<template>
    <div>
        <!-- <Spinner name="pulse" color="#2E92E8"/> -->
        <h4>
            <span>
                <i class="fas fa-dove"></i>
            </span> 宮崎市民活動センターからのお知らせ 情報一覧画面</h4>
        <hr>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="bs-component">
                    <div class="row">
                        <div class="col-md-2">
                            <router-link :to="{ name: 'activeCenterForm' }">
                                <button class="btn btn-primary btn-lg btn-active center">新規登録</button>
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <!-- <div class="form-group col-md-2 mb-4">
                        <select v-model="params.type" v-on:change="onTypeChanged" class="form-control" id="attribute_shikatsu">
                            <option value="0">すべて</option>
                            <option value="1">公開中</option>
                            <option value="2">登録作業中</option>
                            <option value="3">終了</option>
                        </select>
                    </div> -->
                    <div class="form-group col-md-2 mb-4">
                        <multiselect 
                            v-model="selectedDisabledStatus" 
                            :options="disabledStatuses" 
                            @select="onSelectDisabledStatus"  
                            track-by="id" 
                            label="name" 
                            placeholder="公開／非公開" 
                            selectedLabel="" 
                            selectLabel="" 
                            deselectLabel="" >
                        </multiselect>
                    </div>
                    <div class="form-group col-md-2 mb-4">
                        <multiselect 
                            v-model="selectedDateStatus" 
                            :options="dateStatuses" 
                            @select="onSelectDateStatus"  
                            track-by="id" 
                            label="name" 
                            placeholder="公開期間" 
                            selectedLabel="" 
                            selectLabel="" 
                            deselectLabel="" >
                        </multiselect>
                    </div>
                    <div class="form-group col-md-4 offset-sm-4">
                        <div class="input-group">
                            <input type="text" v-model="params.search" class="form-control" @keyup.enter="fetchActiveCenter()">
                            <span class="input-group-btn">
                                <button class="btn btn-outline-primary" @click.prevent="fetchActiveCenter()">
                                    <i class="fas fa-search"></i>
                                </button>
                            </span>
                            <span class="input-group-btn">
                                <button class="btn btn-outline-primary" @click.prevent="clearSearch()">
                                    <i class="fas fa-times"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row col-lg-12 table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr class="table-primary">
                                <th class="col-xs-1" scope="col">No.</th>
								<th class="col-xs-3 wide_s" scope="col">件名</th>
								<th class="col-xs-2 wide_d" scope="col">更新日</th>
								<th class="col-xs-2" align="center">複製</th>
								<th class="col-xs-2" scope="col">変更</th>
								<th class="col-xs-2" scope="col">削除</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="(activeCenter, rowNumber) in activeCenters" v-bind:key="activeCenter.id">
                                <th scope="row">{{((pagination.current_page - 1) * 10) + rowNumber + 1}}</th>
                                <td>{{ activeCenter.title }}</td>
                                <td>{{ activeCenter.updated_at }}</td>
                                <td>
                                    <router-link :to="{ name: 'activeCenterForm', params: { model: activeCenter, requestType: 'copy' }}">
                                        <button class="btn btn-outline-primary btn-block" role="button">複製</button>
                                    </router-link>
                                </td>
                                <td>
                                    <router-link :to="{ name: 'activeCenterForm', params: { model: activeCenter, requestType: 'edit' }}">
                                        <button class="btn btn-outline-success btn-block" role="button">変更</button>
                                    </router-link>
                                </td>
                                <td>
                                    <a class="btn btn-outline-danger btn-block" @click.prevent="deleteActiveCenter(activeCenter.id)" role="button">削除</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <ul class="pagination justify-content-end">
                    <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                        <button class="page-link" href="#!" @click.prevent="fetchActiveCenter(pagination.prev_page_url)">前へ</button>
                    </li>

                    <li class="page-item disabled">
                        <button class="page-link text-dark" href="#!">{{ pagination.current_page }} / {{ pagination.last_page }}</button>
                    </li>

                    <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                        <button class="page-link" href="#!" @click.prevent="fetchActiveCenter(pagination.next_page_url)">次へ</button>
                    </li>
                </ul>
            </div>
        </div>
       
    </div>
</template>

<script>
    import Multiselect from "vue-multiselect"
    import ErrorHandler from '../../../../external/error-handler'
    export default {
        components: { Multiselect},
        data() {
            return {
                selectedActiveCenter: "",
                activeCenters: [],
                activeCenter: {
                    id: "",
                    name: "",
                    comments: "",
                    update_by: "1"
                },
                id: "",
                pagination: {},
                edit: false,
                params: {
                    search: "",
                    type: 0,
                    dateStatus: null,
                    disabled: null
                },
                dateStatuses:[
                    { id: null, name: "すべて" },
                    { id: 1, name: "現在公開中" },
                    { id: 2, name: "公開前" },
                    { id: 3, name: "公開終了" },
                ],
                disabledStatuses:[
                    { id: null, name: "すべて" },
                    { id: 0, name: "公開" },
                    { id: 1, name: "非公開" },
                ],
                selectedDateStatus :  { id: null, name: "すべて" },
                selectedDisabledStatus :  { id: null, name: "すべて" },
            };
        },

        created() {
            this.fetchActiveCenter();
        },

        methods: {
            // Pulling data from API, its a post request with search-term, type
            fetchActiveCenter(page_url) {
                NProgress.start()
                let vm = this;
                page_url = page_url || "/api/active-centers";

                axios.post(page_url, this.params, {
                        headers: {
                            Authorization: 'Bearer ' + localStorage.getItem('token')
                        }
                    })
                    .then(response => {
                        this.activeCenters = response.data.data;
                        console.log(this.activeCenters);
                        vm.makePagination(response.data.meta, response.data.links);
                        NProgress.done()
                    })
                    .catch(error => {
                        if (error.response) {
                            console.log(error.response);
                            NProgress.done()
                            ErrorHandler.handle(error.response.status, this)
                        }
                    });
            },

            // Paginating the table data
            makePagination(meta, links) {
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev
                };

                this.pagination = pagination;
            },

            // Deleting the selected data
            deleteActiveCenter(id) {
                this.$swal({
                    title: 'このデータを削除しますか？',
                    text: "削除したデータは元に戻すことができません!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK',
                    cancelButtonText: 'キャンセル'
                }).then((result) => {
                    if (result.value) {
                        NProgress.start()
                        axios.delete(`/api/active-center/${id}`, {
                            headers: {
                                Authorization: 'Bearer ' + localStorage.getItem('token')
                            }
                        })
                        .then(response => {
                            this.$swal(
                                '削除しました!',
                                '選択したデータが削除されました',
                                'success'
                            )
                            NProgress.done()
                            this.fetchActiveCenter()
                        })
                        .catch(error => {
                            if (error.response) {
                                console.log(error.response);
                                NProgress.done()
                                ErrorHandler.handle(error.response.status, this)
                            }
                        });
                    }
                    else {
                        this.$swal(
                            'キャンセルしました',
                            'データは削除されていません',
                            'error'
                        )
                    }
                })
            },

            // Loads table data on changing 
            onTypeChanged: function (e) {
                this.params.type = event.srcElement.value
                this.fetchActiveCenter()
            },

            // Clearing the user typed search term
            clearSearch() {
                this.params.search = ""
                this.fetchActiveCenter()
            },
            onSelectDateStatus(selectedOption, id) {
                if(selectedOption){
                    console.log(selectedOption.id)
                    this.params.dateStatus = selectedOption.id
                    this.fetchActiveCenter()
                }
            },
            onSelectDisabledStatus(selectedOption, id) {
                if(selectedOption){
                    console.log(selectedOption.id)
                    this.params.disabled = selectedOption.id
                    this.fetchActiveCenter()
                }
            },
        }
    };
</script>