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
                            <router-link :to="{ name: 'disasterForm' }">
                                <button class="btn btn-primary btn-lg btn-active center">新規登録</button>
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="form-group col-md-2 mb-4">
                        <select v-model="params.type" v-on:change="onTypeChanged" class="form-control" id="attribute_shikatsu">
                            <option value="0">すべて</option>
                            <option value="1">公開中</option>
                            <option value="2">登録作業中</option>
                            <option value="3">終了</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4 offset-sm-6">
                        <div class="input-group">
                            <input type="text" v-model="params.search" class="form-control">
                            <span class="input-group-btn">
                                <button class="btn btn-outline-primary" @click="fetchDisaster()">
                                    <i class="fas fa-search"></i>
                                </button>
                            </span>
                            <span class="input-group-btn">
                                <button class="btn btn-outline-primary" @click="clearSearch()">
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
                                <th scope="col">No.</th>
                                <th scope="col">件名</th>
                                <th scope="col">更新日</th>
                                <th scope="col">複製</th>
                                <th scope="col">変更</th>
                                <th scope="col">削除</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="(disaster, rowNumber) in disasters" v-bind:key="disaster.id">
                                <th scope="row">{{((pagination.current_page - 1) * 10) + rowNumber + 1}}</th>
                                <td>{{ disaster.title }}</td>
                                <td>{{ disaster.start_date }}</td>
                                <td>
                                    <button class="btn btn-outline-primary btn-active center" role="button">複製</button>
                                </td>
                                <td>
                                    <router-link :to="{ name: 'disasterForm', params: { model: disaster }}">
                                        <button class="btn btn-outline-success btn-active center" role="button">変更</button>
                                    </router-link>
                                </td>
                                <td>
                                    <a class="btn btn-outline-danger btn-active center" @click="deleteDisaster(disaster.id)" role="button">削除</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <ul class="pagination justify-content-end">
                    <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                        <button class="page-link" href="#" @click="fetchDisaster(pagination.prev_page_url)">前へ</button>
                    </li>

                    <li class="page-item disabled">
                        <button class="page-link text-dark" href="#">ページ {{ pagination.current_page }} の {{ pagination.last_page }}</button>
                    </li>

                    <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                        <button class="page-link" href="#" @click="fetchDisaster(pagination.next_page_url)">次へ</button>
                    </li>
                </ul>
            </div>
        </div>
       
    </div>
</template>

<script>
    export default {
        name: "disaster",
        data() {
            return {
                selecteddisaster: "",
                disasters: [],
                disaster: {
                    id: "",
                    name: "",
                    comments: "",
                    update_by: "1"
                },
                id: "",
                pagination: {},
                edit: false,
                rowCount: 1,
                params: {
                    search: "",
                    type: 0
                }
            };
        },

        created() {
            this.fetchDisaster();
        },

        methods: {
            fetchDisaster(page_url) {
                let loader = this.$loading.show();
                let vm = this;
                page_url = page_url || "/api/disasters";

                fetch(page_url, {
                    method: "post",
                    body: JSON.stringify(this.params),
                    headers: {
                        "content-type": "application/json"
                    }
                })
                    .then(res => res.json())
                    .then(res => {
                        this.disasters = res.data;
                        console.log(this.disasters);
                        vm.makePagination(res.meta, res.links);
                        loader.hide()
                    })
                    .catch(err => console.log(err))
            },
            makePagination(meta, links) {
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev
                };
                this.pagination = pagination;
            },
            deleteDisaster(id) {
                this.$swal({
                    title: '本気ですか',
                    text: "これを元に戻すことはできません!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'はい、削除してください!',
                    cancelButtonText: 'キャンセル'
                }).then((result) => {
                    if (result.value) {
                        let loader = this.$loading.show()
                        fetch(`api/disaster/${id}`, {
                            method: "delete"
                        })
                        .then(res => res.json())
                        .then(data => {
                            loader.hide()
                            this.$swal({
                                title: "削除された!",
                                text: "選択したデータが削除されました",
                                type: "success",
                                confirmButtonText: "よし",
                            })
                            this.fetchDisaster();
                        })
                        .catch(err => console.log(err));
                    }
                    else {
                        this.$swal({
                                title: 'キャンセルされました',
                                text: 'データは安全です :)',
                                type: 'error',
                                confirmButtonText: "よし",
                            }
                        )
                    }
                })
            },
            onTypeChanged: function (e) {
                this.params.type = event.srcElement.value
                this.fetchDisaster()
            },
            clearSearch() {
                this.params.search = ""
                this.fetchDisaster()
            }
        }
    };
</script>