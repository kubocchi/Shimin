<template>
    <div>
        <!-- <Spinner name="pulse" color="#2E92E8"/> -->
        <h4>
            <span>
                <i class="fas fa-dove"></i>
            </span>事業報告  事業名一覧画面</h4>
        <hr>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="bs-component">
                    <div class="row">
                        <div class="col-md-2">
                            <router-link :to="{ name: 'businessForm' }">
                                <button class="btn btn-primary btn-lg btn-active center">新規登録</button>
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="form-group col-md-2 mb-4">
                       
                    </div>
                    <div class="form-group col-md-4 offset-sm-6">
                        <div class="input-group">
                            <input type="text" v-model="params.search" class="form-control">
                            <span class="input-group-btn">
                                <button class="btn btn-outline-primary" @click.prevent="fetchBusiness()">
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
								<th class="col-xs-3 wide_s" scope="col">事業名</th>
								<th class="col-xs-2" align="center">複製</th>
								<th class="col-xs-2" scope="col">変更</th>
								<th class="col-xs-2" scope="col">削除</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="(business, rowNumber) in businesses" v-bind:key="business.id">
                                <th scope="row">{{((pagination.current_page - 1) * 10) + rowNumber + 1}}</th>
                                <td>{{ business.name }}</td>
                                <td>
                                    <router-link :to="{ name: 'businessForm', params: { model: business, requestType: 'copy' }}">
                                        <button class="btn btn-outline-primary btn-block" role="button">複製</button>
                                    </router-link>
                                </td>
                                <td>
                                    <router-link :to="{ name: 'businessForm', params: { model: business, requestType: 'edit' }}">
                                        <button class="btn btn-outline-success btn-block" role="button">変更</button>
                                    </router-link>
                                </td>
                                <td>
                                    <a class="btn btn-outline-danger btn-block" @click.prevent="deleteBusiness(business.id)" role="button">削除</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                 <router-link :to="{ name: 'businessReportList' }">
                    <button class="btn btn-outline-primary">戻る</button>
                </router-link> 
                <ul class="pagination justify-content-end">
                    <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                        <button class="page-link" href="#!" @click.prevent="fetchBusiness(pagination.prev_page_url)">前へ</button>
                    </li>

                    <li class="page-item disabled">
                        <button class="page-link text-dark" href="#!">{{ pagination.current_page }} / {{ pagination.last_page }}</button>
                    </li>

                    <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                        <button class="page-link" href="#!" @click.prevent="fetchBusiness(pagination.next_page_url)">次へ</button>
                    </li>
                </ul>
            </div>
        </div>
       
    </div>
</template>

<script>
    export default {
        data() {
            return {
                businesses: [],
                pagination: {},
                edit: false,
                params: {
                    search: "",
                    type: 0
                }
            };
        },

        created() {
            this.fetchBusiness();
        },

        methods: {
            // Pulling data from API, its a post request with search-term, type
            fetchBusiness(page_url) {
                NProgress.start()
                let vm = this;
                page_url = page_url || "/api/businesses";

                fetch(page_url, {
                    method: "post",
                    body: JSON.stringify(this.params),
                    headers: {
                        "content-type": "application/json"
                    }
                })
                    .then(res => res.json())
                    .then(res => {
                        this.businesses = res.data;
                        console.log(this.businesses);
                        vm.makePagination(res.meta, res.links);
                        NProgress.done()
                    })
                    .catch(err => console.log(err))
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
            deleteBusiness(id) {
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
                        fetch(`/api/business/${id}`, {
                            method: "delete"
                        })
                        .then(res => res.json())
                        .then(data => {
                            this.$swal(
                                '削除しました!',
                                '選択したデータが削除されました',
                                'success'
                            )
                            NProgress.done()
                            this.fetchBusiness()
                        })
                        .catch(err => console.log(err))
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
                this.fetchBusiness()
            },

            // Clearing the user typed search term
            clearSearch() {
                this.params.search = ""
                this.fetchBusiness()
            }
        }
    };
</script>