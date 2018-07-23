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
                        <multiselect v-model="selectedDisabledStatus" :options="disabledStatuses" @select="onSelectDisabledStatus" track-by="id"
                            label="name" placeholder="公開／非公開" selectedLabel="" selectLabel="" deselectLabel="">
                        </multiselect>
                    </div>
                    <div class="form-group col-md-2 mb-4">
                        <multiselect v-model="selectedDateStatus" :options="dateStatuses" @select="onSelectDateStatus" track-by="id" label="name"
                            placeholder="公開期間" selectedLabel="" selectLabel="" deselectLabel="">
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
                <div class="row">
                    <div class="col-lg-4 table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr class="table-primary">
                                    <th class="col-xs-1" scope="col">ID.</th>
                                    <th class="col-xs-9 wide_d" scope="col">件名</th>
                                    <th class="col-xs-2" scope="col">徐外</th>
                                </tr>
                            </thead>

                            <tbody id="tblFeatured" class="connectedSortable">
                                <tr v-for="featuredItem in featuredItems" v-bind:key="featuredItem.id">
                                    <td id="id">{{ featuredItem.id }}</td>
                                    <td id="title">{{ featuredItem.title }}</td>
                                    <td>
                                        <a class="btn-sm btn-outline-danger btn-block" @click.prevent="deleteItem(featuredItem.id)" role="button">除外</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row text-center">
                            <button class="btn btn-outline-success btn-block" @click.prevent="saveFeatured()" role="button">変更</button>
                        </div>
                    </div>
                    <div class="col-lg-8 table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr class="table-primary">
                                    <th class="col-xs-1" scope="col">No.</th>
                                    <th class="col-xs-3 wide_s" scope="col">件名</th>
                                    <th class="col-xs-1 wide_d" scope="col">更新日</th>
                                    <th class="col-xs-1" scope="col">固定</th>
                                    <th class="col-xs-2" scope="col" align="center">複製</th>
                                    <th class="col-xs-2" scope="col">変更</th>
                                    <th class="col-xs-2" scope="col">削除</th>
                                </tr>
                            </thead>

                            <tbody id="tblMain" style="overflow:hidden;">
                                <tr class="mainRow" v-for="(activeCenter, rowNumber) in activeCenters" v-bind:key="activeCenter.id">
                                    <th scope="row">{{((pagination.current_page - 1) * 10) + rowNumber + 1}}</th>
                                    <td id="title">{{ activeCenter.title }}</td>
                                    <td>{{ activeCenter.updated_at }}</td>
                                    <td>
                                        <div v-if="activeCenter.featured != null">
                                            <i class="fas fa-check"></i>
                                        </div>
                                    </td>
                                    <td>
                                        <router-link :to="{ name: 'activeCenterForm', params: { model: activeCenter, requestType: 'copy' }}">
                                            <button class="btn-sm btn-outline-primary btn-block" role="button">複製</button>
                                        </router-link>
                                    </td>
                                    <td>
                                        <router-link :to="{ name: 'activeCenterForm', params: { model: activeCenter, requestType: 'edit' }}">
                                            <button class="btn-sm btn-outline-success btn-block" role="button">変更</button>
                                        </router-link>
                                    </td>
                                    <td>
                                        <a class="btn-sm btn-outline-danger btn-block" @click.prevent="deleteActiveCenter(activeCenter.id)" role="button">削除</a>
                                    </td>
                                    <td id="id" hidden>
                                        {{activeCenter.id}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

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
        components: { Multiselect },
        loadJqueryUI: true,
        data() {
            return {
                selectedActiveCenter: "",
                activeCenters: [],
                featuredItems: [],
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
                dateStatuses: [
                    { id: null, name: "すべて" },
                    { id: 1, name: "現在公開中" },
                    { id: 2, name: "公開前" },
                    { id: 3, name: "公開終了" },
                ],
                disabledStatuses: [
                    { id: null, name: "すべて" },
                    { id: 0, name: "公開" },
                    { id: 1, name: "非公開" },
                ],
                selectedDateStatus: { id: null, name: "すべて" },
                selectedDisabledStatus: { id: null, name: "すべて" },
                featuredItems : []
            };
        },

        created() {
            this.fetchActiveCenter()
            this.fetchFeaured()
            this.initDraggable()
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
                                this.fetchFeaured()
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
                if (selectedOption) {
                    console.log(selectedOption.id)
                    this.params.dateStatus = selectedOption.id
                    this.fetchActiveCenter()
                }
            },
            onSelectDisabledStatus(selectedOption, id) {
                if (selectedOption) {
                    console.log(selectedOption.id)
                    this.params.disabled = selectedOption.id
                    this.fetchActiveCenter()
                }
            },
            saveFeatured() {
                NProgress.start()
                let ids = []
                $('#tblFeatured').find('tr').each(function () {
                    //ids.push($(this).find('td.id').text().trim())
                    ids.push($(this).find("td:first").text().trim())
                })

                console.log(ids)
                //let detail = ids.join(',')

                axios.post("/api/active-center-featured", {detail: ids}, {
                    headers: {
                        Authorization: 'Bearer ' + localStorage.getItem('token')
                    }
                })
                    .then(response => {
                        this.fetchActiveCenter()
                        NProgress.done()
                        self.$swal({
                            title: "登録完了!",
                            text: "登録が完了しました!",
                            type: "success",
                            confirmButtonText: 'OK'
                        })
                            
                    })
                    .catch(error => {
                        NProgress.done()
                        if (error.response) {
                            console.log(error.response);
                            if (error.response.status === 401) {
                                window.location.href = '/login'
                            }
                        }
                    });
                console.log(ids)
                
            },
            fetchFeaured() {
                NProgress.start()
                axios.get(`/api/active-center-featured`, {
                    headers: {
                        Authorization: 'Bearer ' + localStorage.getItem('token')
                    }
                })
                    .then(response => {
                        this.featuredItems = response.data.data;
                        if(!this.featuredItems.length){
                            $('#tblFeatured').append(`<tr class='mainRow'><td></td><td>No data!</td><td></td></tr>`)
                        }

                        console.log(response.data.data);
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
            deleteItem(id){
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
                        this.featuredItems = this.featuredItems.filter(item =>{
                            return item.id !== id;
                        })

                        if(!this.featuredItems.length){
                            $('#tblFeatured').append(`<tr class='mainRow'><td></td><td>No data!</td><td></td></tr>`)
                        }
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
            initDraggable(){
                let vm = this
                $(function () {
                    console.log('Length: ', $('#tblFeatured').find('tr').length)

                    // Draggable
                    $("#tblMain").sortable({
                        connectWith: ".connectedSortable",
                        remove: function (event, ui) {
                            ui.item.clone().insertAfter(ui.item);
                            $(this).sortable('cancel');
                        },
                        beforeStop: function (ev, ui) {
                            if ($(ui.placeholder).parent()[0] == this) {
                                $(this).sortable('cancel');
                            }
                        },
                        axis: 'y'
                    }).disableSelection();

                    // Droppable
                    $("#tblFeatured").sortable({
                        connectWith: ".connectedSortable",
                        receive: function (event, ui) {
                            $('#tblFeatured tr.mainRow').remove()

                            if(vm.featuredItems.length == 10){
                                vm.$swal(
                                        'ごめんなさい！',
                                        '満ちている最大!',
                                        'warning'
                                    )
                                return
                            } 

                            let id = ui.item.find('td#id').text().trim()
                            let title = ui.item.find('td#title').text().trim()

                            if(vm.featuredItems.find(x => x.id === id)){
                                vm.$swal(
                                    'ごめんなさい！',
                                    'もう存在している！',
                                    'warning'
                                )
                                return
                            }

                            let newItem = {id: id, title: title}
                            vm.featuredItems.push(newItem)
                        },
                        axis: 'y'
                    }).disableSelection()
                })
            }
        }
    };
</script>