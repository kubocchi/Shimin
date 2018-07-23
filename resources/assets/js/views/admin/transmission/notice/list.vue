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
                    <div class="form-group col-md-2 mb-4">
                        <multiselect 
                            v-model="selectedNoticeType" 
                            :options="noticeTypes" 
                            @select="onSelectNoticeType"  
                            track-by="id" 
                            label="name" 
                            placeholder="種別" 
                            selectedLabel="" 
                            selectLabel="" 
                            deselectLabel="" >
                        </multiselect>
                    </div>
                    <div class="form-group col-md-4 offset-sm-2">
                        <div class="input-group">
                            <input type="text" v-model="params.search" class="form-control" @keyup.enter="fetchNotice()">
                            <span class="input-group-btn">
                                <button class="btn btn-outline-primary" @click.prevent="fetchNotice()">
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
								<th class="col-xs-2 wide_d" scope="col">種別</th>
								<th class="col-xs-4 wide_s" scope="col">件名</th>
								<th class="col-xs-2 wide_d" scope="col">開催期間</th>
								<th class="col-xs-1" scope="col">複製</th>
								<th class="col-xs-1" scope="col">変更</th>
								<th class="col-xs-1" scope="col">削除</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="(notice, rowNumber) in notices" v-bind:key="rowNumber">
                                <th scope="row">{{parseInt(rowNumber) + 1}}</th>
                                <td>{{ notice.type }}</td>
                                <td>{{ notice.subject }}</td>
                                <td>{{ notice.date }}</td>
                                <td>
                                    <button class="btn btn-outline-primary btn-block" role="button" @click.prevent="copyOrEdit(notice, 'copy')">複製</button>
                                </td>
                                <td>
                                    <button class="btn btn-outline-success btn-block" role="button"  @click.prevent="copyOrEdit(notice, 'edit')">変更</button>
                                </td>
                                <td>
                                    <a class="btn btn-outline-danger btn-block" @click.prevent="deleteNotice(notice)" role="button">削除</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <ul class="pagination justify-content-end">
                    <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                        <button class="page-link" href="#!" @click.prevent="fetchNotice(pagination.prev_page_url)">前へ</button>
                    </li>

                    <li class="page-item disabled">
                        <button class="page-link text-dark" href="#!">{{ pagination.current_page }} / {{ pagination.last_page }}</button>
                    </li>

                    <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                        <button class="page-link" href="#!" @click.prevent="fetchNotice(pagination.next_page_url)">次へ</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
 import Multiselect from "vue-multiselect"
    export default {
        components: { Multiselect},
        data() {
            return {
                notices: [],
                pagination: {},
                params: {
                    search: "",
                    noticeType: 0,
                    disabled: null,
                    dateStatus: null
                },
                noticeTypes:[
                    { id: 0, name: "すべて" },
                    { id: 1, name: "イベント" },
                    { id: 2, name: "ボランティア" },
                    { id: 3, name: "会員募集" },
                ],
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
                selectedNoticeType :  { id: 0, name: "すべて" },
                selectedDateStatus :  { id: null, name: "すべて" },
                selectedDisabledStatus :  { id: null, name: "すべて" },
            };
        },

        created() {
            this.fetchNotice();
        },

        methods: {
            // Pulling data from API, its a post request with search-term, type
            fetchNotice(page_url) {
                NProgress.start()
                page_url = page_url || "/api/notices";

                fetch(page_url, {
                    method: "post",
                    body: JSON.stringify(this.params),
                    headers: {
                        "content-type": "application/json"
                    }
                })
                    .then(res => res.json())
                    .then(res => {
                        this.notices = res.data.data
                        console.log(res.data)
                        this.makePagination(res)
                        NProgress.done()
                    })
                    .catch(err => console.log(err))
            },

            // Paginating the table data
            makePagination(res) {
                let pagination = {
                    current_page: res.data.current_page,
                    last_page: res.data.last_page,
                    next_page_url: res.data.next_page_url,
                    prev_page_url: res.data.prev_page_url
                }

                this.pagination = pagination
            },

            // Deleting the selected data
            deleteNotice(object) {
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
                        let routeName = ''
                        
                        switch (object.type) {
                            case 'イベント':
                                routeName = 'event'
                                break;
                            case 'ボランティア':
                                routeName = 'volunteer'
                                break;
                            case '会員募集':
                                routeName = 'membership'
                                break;
                            }

                        fetch(`/api/${routeName}/${object.id}`, {
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
            },
            copyOrEdit(object, type){
                console.log(object, type)
                let routeName = ''
                switch (object.type) {
                    case 'イベント':
                        routeName = 'noticeEventForm'
                        break;
                    case 'ボランティア':
                        routeName = 'noticeVolunteerForm'
                        break;
                    case '会員募集':
                        routeName = 'noticeMembershipForm'
                        break;
                }
                this.$router.push({name: routeName, params: {model: object, requestType: type }})
            },
            onSelectNoticeType(selectedOption, id) {
                if(selectedOption){
                    console.log(selectedOption.id)
                    this.params.noticeType = selectedOption.id
                    this.fetchNotice()
                }
            },
            onSelectDateStatus(selectedOption, id) {
                if(selectedOption){
                    console.log(selectedOption.id)
                    this.params.dateStatus = selectedOption.id
                    this.fetchNotice()
                }
            },
            onSelectDisabledStatus(selectedOption, id) {
                if(selectedOption){
                    console.log(selectedOption.id)
                    this.params.disabled = selectedOption.id
                    this.fetchNotice()
                }
            },
        }
    };
</script>