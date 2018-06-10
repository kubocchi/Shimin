<template>
    <div >
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
                    <div class="form-group col-md-2 mb-4">
                        <select class="form-control" id="attribute_shikatsu">
                            <option>すべて</option>
                            <option>公開中</option>
                            <option>登録作業中</option>
                            <option>終了</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4 offset-sm-6">
                        <div class="input-group">
                            <input type="text" class="form-control">
                            <span class="input-group-btn">
                                <button class="btn btn-outline-primary" type="submit">
                                    <i class="fas fa-search"></i>
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
                            <tr v-for="(activeCenter,index) in activeCenters" v-bind:key="activeCenter.id">
                                <th scope="row">{{index + 1}}</th>
                                <td>{{ activeCenter.title }}</td>
                                <td>{{ activeCenter.start_date }}</td>
                                <td>
                                    <router-link :to="{ name: 'activeCenterForm', params: { id: activeCenter }}">
                                        <a class="btn btn-outline-primary btn-active center" role="button">複製</a>
                                    </router-link>
                                </td>
                                <td>
                                    <a class="btn btn-outline-success btn-active center" href="#" role="button">変更</a>
                                </td>
                                <td>
                                    <a class="btn btn-outline-danger btn-active center" @click="deleteActiveCenter(activeCenter.id)" role="button">削除</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- <nav aria-label="Page navigation shikatsu">
                    <ul class="pagination justify-content-end">
                        <li class="page-item">
                            <a class="page-link" href="#">前へ</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">次へ</a>
                        </li>
                    </ul>
                </nav> -->
                 <ul class="pagination justify-content-end">
                    <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                        <a class="page-link" href="#" @click="fetchActiveCenter(pagination.prev_page_url)">前へ</a>
                    </li>

                    <li class="page-item disabled">
                        <a class="page-link text-dark" href="#">ページ {{ pagination.current_page }} の {{ pagination.last_page }}</a>
                    </li>

                    <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                        <a class="page-link" href="#" @click="fetchActiveCenter(pagination.next_page_url)">次へ</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "company",
        data() {
            return {
                selectedActiveCenter: "",
                activeCenters: [],
                activeCenter: {
                    id: "",
                    name: "",
                    comments:"",
                    update_by: "1"
                },
                id: "",
                pagination: {},
                edit: false
            };
        },

        created() {
            this.fetchActiveCenter();
        },

        methods: {
            fetchActiveCenter(page_url) {
                let vm = this;
                page_url = page_url || "/api/active-centers";
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.activeCenters = res.data;
                    console.log(this.activeCenters);
                    vm.makePagination(res.meta, res.links);
                })
                .catch(err => console.log(err)); 
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
            deleteActiveCenter(id) {
                if (confirm("Are You Sure?")) {
                    fetch(`api/active-center/${id}`, {
                        method: "delete"
                    })
                    .then(res => res.json())
                    .then(data => {
                        alert("active center Removed");
                        this.fetchActiveCenter();
                    })
                    .catch(err => console.log(err));
                }
            }
        }
    };
</script>