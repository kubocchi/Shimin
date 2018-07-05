<template>
    <div>
        <!-- <Spinner name="pulse" color="#2E92E8"/> -->
        <h4>
            <span>
                <i class="fas fa-feather"></i>
            </span> 団体情報 一覧画面</h4>
        <hr>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="bs-component">
                    <div class="col-md-2 mb-4">
                        <router-link :to="{ name: 'groupInformationForm' }">
                            <button class="btn btn-primary btn-lg btn-block">新規登録</button>
                        </router-link>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="form-group col-md-2 mb-4">
                        <multiselect v-model="selectedManagement" :options="managements" @select="onSelectManagement" track-by="id" label="label"
                            placeholder="区分" selectLabel="" deselectLabel="" selectedLabel="選ばれた" v-validate="'required'" name="business"
                            data-vv-as="登録場所">
                        </multiselect>
                    </div>
                    <div class="form-group col-md-2 mb-4">
                        <multiselect v-model="selectedstatus" :options="statuses" @select="onSelectStatus" track-by="id" label="label" placeholder="ステータス"
                            selectLabel="" deselectLabel="" selectedLabel="選ばれた" v-validate="'required'" name="business" data-vv-as="登録場所">
                        </multiselect>
                    </div>
                    <div class="form-group col-md-2 mb-4">
                        <multiselect v-model="selectedType" :options="types" @select="onSelectType" track-by="id" label="label" placeholder="種別"
                            selectLabel="" deselectLabel="" selectedLabel="選ばれた" v-validate="'required'" name="business" data-vv-as="登録場所">
                        </multiselect>
                    </div>
                    <div class="form-group col-md-2 mb-4">
                        <multiselect v-model="selectedActivityCategory" :options="activityCategories" @select="onSelectActivityCategory" track-by="id"
                            label="name" placeholder="活動分類" selectLabel="" deselectLabel="" selectedLabel="選ばれた" v-validate="'required'"
                            name="business" data-vv-as="登録場所">
                        </multiselect>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="input-group">
                            <input type="text" v-model="params.search" class="form-control">
                            <span class="input-group-btn">
                                <button class="btn btn-outline-primary" @click.prevent="fetchGroupInformation()">
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
                    <table class="table table-sm list_table">
                        <thead>
                            <tr class="table-primary">
                                <th class="col-xs-1" scope="col">No.</th>
                                <th class="col-xs-1 wide_d" scope="col">登録場所</th>
                                <th class="col-xs-1 wide_d" scope="col">公開状況</th>
                                <th class="col-xs-1 wide_d" scope="col">種類</th>
                                <th class="col-xs-2 wide_d" scope="col">活動分類</th>
                                <th class="col-xs-4 wide_s" scope="col">団体名</th>
                                <th class="col-xs-1" scope="col">変更</th>
                                <th class="col-xs-1" scope="col">削除</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="( groupInformation, rowNumber) in groupInformations" :key=rowNumber>
                                <th scope="row">{{((pagination.current_page - 1) * 10) + rowNumber + 1}}</th>
                                <td>{{ getManagement(parseInt(groupInformation.regist_management)) }}</td>  <!-- ==> groupInformation.management -->
                                <td>{{ getStatus(parseInt(groupInformation.open_situation)) }}</td>  <!-- ==> groupInformation.statuses -->
                                <td>{{ getType(parseInt(groupInformation.type)) }}</td>
                                <td>{{ getActivityCategoryName(groupInformation.activity_category) }}</td>
                                <td>{{ groupInformation.name }}</td>
                                <td>
                                    <router-link :to="{ name: ' groupInformationForm', params: { model:  groupInformation, requestType: 'edit' }}">
                                        <button class="btn btn-outline-success btn-block" role="button">変更</button>
                                    </router-link>
                                </td>
                                <td>
                                    <a class="btn btn-outline-danger btn-block" @click.prevent="deleteGroupInformation( groupInformation.id)" role="button">削除</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- <div class="bs-component">
                    <div class="row">
                        <div class="col-md-2 mt-4">
                            <a class="btn btn-outline-primary  btn-block" href="#!" role="button">CSV出力</a>
                        </div>
                        <div class="col-md-2 mt-4 mb-4">
                            <a class="btn btn-outline-primary  btn-block" href="#!" role="button">CSV入力</a>
                            <label>File
                                <input type="file" id="file" ref="file" v-on:change="handleFileUpload()" />
                            </label>
                            <button v-on:click="submitFile()">Submit</button>
                        </div>
                    </div>
                </div> -->
                <div class="bs-component">
                    <div class="row">
                        <div class="col-md-2 mt-4"> <a class="btn btn-outline-primary  btn-block" href="#!" role="button">CSV出力</a> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 mt-4 mb-4"> <a class="btn btn-outline-primary  btn-block" v-on:click="submitFile()" href="#!" role="button">CSV入力</a> </div>
                        <div class="form-group">
                            <div class="form-inline">
                                <div class="form-group mt-4">
                                    <input aria-describedby="fileHelp" class=" btn form-control-file" id="file" ref="file" v-on:change="handleFileUpload()" type="file">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="pagination justify-content-end">
                    <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                        <button class="page-link" href="#!" @click.prevent="fetchGroupInformation(pagination.prev_page_url)">前へ</button>
                    </li>

                    <li class="page-item disabled">
                        <button class="page-link text-dark" href="#!">{{ pagination.current_page }} / {{ pagination.last_page }}</button>
                    </li>

                    <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                        <button class="page-link" href="#!" @click.prevent="fetchGroupInformation(pagination.next_page_url)">次へ</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import Multiselect from "vue-multiselect";
    export default {
        components: { Multiselect },
        data() {
            return {
                groupInformations: [],
                pagination: {},
                edit: false,
                params: {
                    search: "",
                    management: null,
                    activityCategory: null,
                    status: null,
                    type: null
                },
                managements: [
                    { id: null, label: "すべて" },
                    { id: 1, 'label': 'センター' },
                    { id: 2, 'label': '社協' },
                    { id: 3, 'label': '佐土原' },
                    { id: 4, 'label': '高岡' },
                    { id: 5, 'label': '田野' },
                    { id: 6, 'label': '清武' },
                ],
                selectedManagement: { id: null, label: "すべて" },
                activityCategories: [
                    { id: null, name: "すべて"},
                    { id: "100", name: "保健・医療" },
                    { id: "200", name: "高齢者福祉" },
                    { id: "300", name: "障害者福祉" },
                    { id: "400", name: "児童福祉" },
                    { id: "500", name: "社会教育" },
                    { id: "600", name: "まちづくり" },
                    { id: "700", name: "観光" },
                    { id: "800", name: "農山漁村" },
                    { id: "900", name: "文化芸術" },
                    { id: "1000", name: "環境保全" },
                    { id: "1100", name: "災害救援" },
                    { id: "1200", name: "地域安全" },
                    { id: "1300", name: "人権・平和" },
                    { id: "1400", name: "国際協力" },
                    { id: "1500", name: "男女共同" },
                    { id: "1600", name: "子供育成" },
                    { id: "1700", name: "情報社会" },
                    { id: "1800", name: "科学技術" },
                    { id: "1900", name: "経済活動" },
                    { id: "2000", name: "職業・雇用" },
                    { id: "2100", name: "消費者保護" },
                    { id: "2200", name: "NPO支援" },
                    { id: "2300", name: "その他区分" }
                ],
                selectedActivityCategory: { id: null, name: "すべて" },
                statuses: [
                    { 'id': null, 'label': 'すべて' },
                    { 'id': 0, 'label': '公開' },
                    { 'id': 1, 'label': '非公開' },
                ],
                selectedstatus: { 'id': null, 'label': 'すべて' },
                types: [
                    { id: null, label: 'すべて' },
                    { id: 0, label: '団体' },
                    { id: 1, label: '個人' },
                ],
                selectedType: { 'id': null, 'label': 'すべて' },
            };
        },

        created() {
            this.fetchGroupInformation();
        },

        methods: {
            // Pulling data from API, its a post request with search-term, type
            fetchGroupInformation(page_url) {
                let loader = this.$loading.show();
                let vm = this;
                page_url = page_url || "/api/group-informations";

                fetch(page_url, {
                    method: "post",
                    body: JSON.stringify(this.params),
                    headers: {
                        "content-type": "application/json"
                    }
                })
                    .then(res => res.json())
                    .then(res => {
                        this.groupInformations = res.data;
                        console.log(this.groupInformations);
                        vm.makePagination(res.meta, res.links);
                        loader.hide();
                    })
                    .catch(err => console.log(err));
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
            deleteGroupInformation(id) {
                this.$swal({
                    title: "このデータを削除しますか？",
                    text: "削除したデータは元に戻すことができません!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "OK",
                    cancelButtonText: "キャンセル"
                }).then(result => {
                    if (result.value) {
                        let loader = this.$loading.show();
                        fetch(`/api/group-information/${id}`, {
                            method: "delete"
                        })
                            .then(res => res.json())
                            .then(data => {
                                this.$swal(
                                    "削除しました!",
                                    "選択したデータが削除されました",
                                    "success"
                                );
                                loader.hide();
                                this.fetchGroupInformation();
                            })
                            .catch(err => console.log(err));
                    } else {
                        this.$swal(
                            "キャンセルしました",
                            "データは削除されていません",
                            "error"
                        );
                    }
                });
            },

            // Loads table data on changing
            onTypeChanged: function (e) {
                this.params.type = event.srcElement.value;
                this.fetchGroupInformation();
            },

            // Clearing the user typed search term
            clearSearch() {
                this.params.search = "";
                this.fetchGroupInformation();
            },
            /*
                Submits the file to the server
            */
            submitFile() {
                /*
                    Initialize the form data
                */
                let formData = new FormData();
                /*
                    Add the form data we need to submit
                */
                formData.append('file', this.file);

                /*
                Make the request to the POST /single-file URL
                */
                axios.post('/api/uploadCSV',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(function () {
                    console.log('SUCCESS!!');
                })
                    .catch(function () {
                        console.log('FAILURE!!');
                    });
            },

            /*
                Handles a change on the file upload
            */
            handleFileUpload() {
                this.file = this.$refs.file.files[0];
            },
            onSelectManagement(selectedOption, id) {
                if (selectedOption) {
                    this.params.management = selectedOption.id
                    console.log(selectedOption.id)
                    this.fetchGroupInformation()
                }
            },
            onSelectActivityCategory(selectedOption, id) {
                if (selectedOption) {
                    this.params.activity_category = selectedOption.id
                    console.log(selectedOption.id)
                    this.fetchGroupInformation()
                }
            },
            onSelectStatus(selectedOption, id) {
                if (selectedOption) {
                    this.params.status = selectedOption.id
                    console.log(selectedOption.id)
                    this.fetchGroupInformation()
                }
            },
            onSelectType(selectedOption, id) {
                if (selectedOption) {
                    this.params.type = selectedOption.id
                    console.log(selectedOption.id)
                    this.fetchGroupInformation()
                }
            },
            getActivityCategoryName(id) {
                return this.activityCategories.find(x => x.id === id).name
            },
            getType(id) {
                return this.types.find(x => x.id === id) ? this.types.find(x => x.id === id).label : ''
            },
            getStatus(id) {
                return this.statuses.find(x => x.id === id) ? this.statuses.find(x => x.id === id).label : ''
            },
            getManagement(id) {
                return this.managements.find(x => x.id === id) ? this.managements.find(x => x.id === id).label : ''
            },
        }
    };
</script>