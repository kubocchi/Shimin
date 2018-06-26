<template>
    <div>
        <!-- <Spinner name="pulse" color="#2E92E8"/> -->
        <h4>
            <span>
                <i class="fas fa-dove"></i>
            </span>登録団体、行政などからのお知らせ 一覧画面</h4>
        <hr>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="bs-component">
					<div class="row">
						<div class="col-md-4 mb-3">
                            <router-link :to="{ name: 'noticeEventForm' }">
                                <button class="btn btn-primary btn-lg btn-block">イベント登録</button>
                            </router-link>
						</div>
						<div class="col-md-4 mb-3">
                            <router-link :to="{ name: 'noticeVolunteerForm' }">
                                <button class="btn btn-primary btn-lg btn-block">ボランティア情報登録</button>
                            </router-link>
						</div>
						<div class="col-md-4">
                            <router-link :to="{ name: 'noticeMembershipForm' }">
                                <button class="btn btn-primary btn-lg btn-block">会員募集登録</button>
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
                    <div class="form-group col-md-3 mb-4">
                        <select class="form-control" id="attribute_dantai">
                            <option>
                                すべて
                            </option>
                            <option>
                                イベント
                            </option>
                            <option>
                                ボランテイア情報
                            </option>
                            <option>
                                会員募集
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-md-4 offset-sm-3">
                        <div class="input-group">
                            <input type="text" v-model="params.search" class="form-control">
                            <span class="input-group-btn">
                                <button class="btn btn-outline-primary" @click="fetchNotice()">
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
                                <th class="col-xs-1" scope="col">No.</th>
								<th class="col-xs-3 wide_s" scope="col">件名</th>
								<th class="col-xs-2 wide_d" scope="col">更新日</th>
								<th class="col-xs-2" align="center">複製</th>
								<th class="col-xs-2" scope="col">変更</th>
								<th class="col-xs-2" scope="col">削除</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="(notice, rowNumber) in notices" v-bind:key="notice.id">
                                <th scope="row">{{((pagination.current_page - 1) * 10) + rowNumber + 1}}</th>
                                <td>{{ notice.subject }}</td>
                                <td>{{ notice.id }}</td>
                                <td>
                                    <router-link :to="{ name: 'noticeForm', params: { model: notice, requestType: 'copy' }}">
                                        <button class="btn btn-outline-primary btn-block" role="button">複製</button>
                                    </router-link>
                                </td>
                                <td>
                                    <router-link :to="{ name: 'noticeForm', params: { model: notice, requestType: 'edit' }}">
                                        <button class="btn btn-outline-success btn-block" role="button">変更</button>
                                    </router-link>
                                </td>
                                <td>
                                    <a class="btn btn-outline-danger btn-block" @click="deleteNotice(notice.id)" role="button">削除</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <ul class="pagination justify-content-end">
                    <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                        <button class="page-link" href="#" @click="fetchNotice(pagination.prev_page_url)">前へ</button>
                    </li>

                    <li class="page-item disabled">
                        <button class="page-link text-dark" href="#">{{ pagination.current_page }} / {{ pagination.last_page }}</button>
                    </li>

                    <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                        <button class="page-link" href="#" @click="fetchNotice(pagination.next_page_url)">次へ</button>
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
                notices: [],
                pagination: {},
                edit: false,
                params: {
                    search: "",
                    type: 0
                }
            };
        },

        created() {
            this.fetchNotice();
        },

        methods: {
            // Pulling data from API, its a post request with search-term, type
            fetchNotice(page_url) {
                let loader = this.$loading.show();
                let vm = this;
                page_url = page_url || "/api/notices";

                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.notices = res.data;
                        console.log(res.data);
                        //vm.makePagination(res.meta, res.links);
                        loader.hide()
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
            deleteNotice(id) {
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
                        let loader = this.$loading.show();
                        fetch(`api/notice/${id}`, {
                            method: "delete"
                        })
                        .then(res => res.json())
                        .then(data => {
                            this.$swal(
                                '削除しました!',
                                '選択したデータが削除されました',
                                'success'
                            )
                            loader.hide()
                            this.fetchNotice()
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
                this.fetchNotice()
            },

            // Clearing the user typed search term
            clearSearch() {
                this.params.search = ""
                this.fetchNotice()
            }
        }
    };
</script>