<template>
    <div>
        <!-- <Spinner name="pulse" color="#2E92E8"/> -->
        <h4>
            <span>
                <i class="fas fa-file"></i>
            </span>  かわら版 一覧画面</h4>
        <hr>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="bs-component">
                    <div class="row">
                        <div class="col-md-2">
                            <router-link :to="{ name: 'kawarabiForm' }">
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
                                <button class="btn btn-outline-primary" @click.prevent="fetchKawarabi()">
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
								<th class="col-xs-2 wide_d" scope="col">ステータス</th>
								<th class="col-xs-3 wide_s" scope="col">件名</th>
								<th class="col-xs-2 wide_d" scope="col">登録日</th>
								<th class="col-xs-2 wide_d" scope="col">更新日</th>
								<th class="col-xs-1" scope="col">変更</th>
								<th class="col-xs-1" scope="col">削除</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="(kawarabi, rowNumber) in kawarabis" v-bind:key="kawarabi.id">
                                <th scope="row">{{((pagination.current_page - 1) * 10) + rowNumber + 1}}</th>
                                <td></td>
                                <td>{{ kawarabi.subject }}</td>
                                <td>{{ kawarabi.created_at }}</td>
                                <td>{{ kawarabi.updated_at }}</td>
                                <td>
                                    <router-link :to="{ name: 'kawarabiForm', params: { model: kawarabi, requestType: 'edit' }}">
                                        <button class="btn btn-outline-success btn-block" role="button">変更</button>
                                    </router-link>
                                </td>
                                <td>
                                    <a class="btn btn-outline-danger btn-block" @click.prevent="deleteKawarabi(kawarabi.id)" role="button">削除</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <ul class="pagination justify-content-end">
                    <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                        <button class="page-link" href="#!" @click.prevent="fetchKawarabi(pagination.prev_page_url)">前へ</button>
                    </li>

                    <li class="page-item disabled">
                        <button class="page-link text-dark" href="#!">{{ pagination.current_page }} / {{ pagination.last_page }}</button>
                    </li>

                    <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                        <button class="page-link" href="#!" @click.prevent="fetchKawarabi(pagination.next_page_url)">次へ</button>
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
                selectedkawarabi: "",
                kawarabis: [],
                kawarabi: {
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
                    type: 0
                }
            };
        },

        created() {
            this.fetchKawarabi();
        },

        methods: {
            // Pulling data from API, its a post request with search-term, type
            fetchKawarabi(page_url) {
                NProgress.start()
                let vm = this;
                page_url = page_url || "/api/kawarabis";

                fetch(page_url, {
                    method: "post",
                    body: JSON.stringify(this.params),
                    headers: {
                        "content-type": "application/json"
                    }
                })
                    .then(res => res.json())
                    .then(res => {
                        this.kawarabis = res.data;
                        console.log(this.kawarabis);
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
            deleteKawarabi(id) {
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
                        fetch(`/api/kawarabi/${id}`, {
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
                            this.fetchKawarabi()
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
                this.fetchKawarabi()
            },

            // Clearing the user typed search term
            clearSearch() {
                this.params.search = ""
                this.fetchKawarabi()
            }
        }
    };
</script>