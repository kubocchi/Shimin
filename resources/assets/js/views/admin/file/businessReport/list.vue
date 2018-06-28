<template>
    <div>
        <!-- <Spinner name="pulse" color="#2E92E8"/> -->
        <h4>
            <span>
                <i class="fas fa-file"></i>
            </span>事業報告 一覧画面</h4>
        <hr>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="bs-component">
                    <div class="row">
                        <div class="col-md-2 mb-4">
                            <router-link :to="{ name: 'businessReportForm' }">
                                <button class="btn btn-primary btn-lg btn-block">新規登録</button>
                            </router-link>
                        </div>
                        <div class="col-md-2 offset-md-6  mb-4">
                            <router-link :to="{ name: 'yearList' }">
                                <button class="btn btn-primary btn-lg btn-block">年度登録</button>
                            </router-link>
                        </div>
                        <div class="col-md-2  mb-4">
                            <router-link :to="{ name: 'businessList' }">
                                <button class="btn btn-primary btn-lg btn-block">事業登録</button>
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="form-group col-md-3 mb-4">
                         <multiselect 
                            v-model="selectedYear" 
                            :options="years" 
                            @select="onSelectYear"  
                            track-by="id" 
                            label="year" 
                            placeholder="選んでください" 
                            selectLabel="クリックして選択する" 
                            deselectLabel="クリックして選択を解除する" 
                            selectedLabel="選ばれた" 
                            v-validate="'required'" 
                            name="year" 
                            data-vv-as="事業名">
                        </multiselect>
                    </div>
                    <div class="form-group col-md-4 offset-sm-5">
                        <div class="input-group">
                            <input type="text" v-model="params.search" class="form-control">
                            <span class="input-group-btn">
                                <button class="btn btn-outline-primary" @click="fetchBusinessReport()">
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
								<th class="col-xs-2 wide_d" scope="col">年度</th>
								<th class="col-xs-2 wide_d" scope="col">事業名</th>
								<th class="col-xs-3 wide_s" scope="col">件名</th>
								<th class="col-xs-2 wide_d" scope="col">更新日</th>
								<th class="col-xs-1" scope="col">変更</th>
								<th class="col-xs-1" scope="col">削除</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="(businessReport, rowNumber) in businessReports" v-bind:key="businessReport.id">
                                <th scope="row">{{((pagination.current_page - 1) * 10) + rowNumber + 1}}</th>
                                <td>{{ businessReport.year.year }}</td>
                                <td>{{ businessReport.business.name }}</td>
                                <td>{{ businessReport.attachment.name}}</td>
                                <td>{{ businessReport.created_at }}</td>
                                <td>
                                    <router-link :to="{ name: 'businessReportForm', params: { model: businessReport, requestType: 'edit' }}">
                                        <button class="btn btn-outline-success btn-block" role="button">変更</button>
                                    </router-link>
                                </td>
                                <td>
                                    <a class="btn btn-outline-danger btn-block" @click="deleteBusinessReport(businessReport.id)" role="button">削除</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <ul class="pagination justify-content-end">
                    <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                        <button class="page-link" href="#" @click="fetchBusinessReport(pagination.prev_page_url)">前へ</button>
                    </li>

                    <li class="page-item disabled">
                        <button class="page-link text-dark" href="#">{{ pagination.current_page }} / {{ pagination.last_page }}</button>
                    </li>

                    <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                        <button class="page-link" href="#" @click="fetchBusinessReport(pagination.next_page_url)">次へ</button>
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
                businessReports: [],
                pagination: {},
                edit: false,
                params: {
                    search: "",
                    year: null
                },
                years: [],
                selectedYear: null
            };
        },

        created() {
            this.fetchBusinessReport()
            this.fetchYear()
        },

        methods: {
            // Pulling data from API, its a post request with search-term, type
            fetchBusinessReport(page_url) {
                let loader = this.$loading.show();
                let vm = this;
                page_url = page_url || "/api/business-reports";

                fetch(page_url, {
                    method: "post",
                    body: JSON.stringify(this.params),
                    headers: {
                        "content-type": "application/json"
                    }
                })
                    .then(res => res.json())
                    .then(res => {
                        this.businessReports = res.data;
                        console.log(this.businessReports);
                        vm.makePagination(res.meta, res.links);
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
            deleteBusinessReport(id) {
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
                        fetch(`api/business-report/${id}`, {
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
                            this.fetchBusinessReport()
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
                this.fetchBusinessReport()
            },

            // Clearing the user typed search term
            clearSearch() {
                this.params.search = ""
                this.fetchBusinessReport()
            },
             // Pulling data from API, its a post request with search-term, type
            fetchYear(page_url) {
                let loader = this.$loading.show();
                let vm = this;
                page_url = page_url || "/api/years";

                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.years = res.data;
                        console.log(this.years);
                        let fakeOption = {'id' : null, 'year': 'すべて'}
                        this.years.unshift(fakeOption)
                        this.selectedYear = fakeOption
                        loader.hide()
                    })
                    .catch(err => console.log(err))
            },
            onSelectYear(selectedOption, id) {
                if(selectedOption){
                    console.log(selectedOption.id)
                    this.params.year = selectedOption.id
                    this.fetchBusinessReport()
                }
            },
        }
    };
</script>