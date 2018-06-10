<template>
    <div>
        <h4>
            <span>
                <i class="fas fa-dove"></i>
            </span> 宮崎市民活動センターからのお知らせ 情報登録画面</h4>
        <hr>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="bs-component">
                    <form @submit.prevent="addActiveCenter">
                        <fieldset>
                            <div class="form-group">
                                <label class="col-form-label" for="subject">【件名】（必須）</label> 
                                <input class="form-control" v-model="activeCenter.title" placeholder="件名" id="subject" type="text" required>
                            </div>
                            <div class="form-group"> 
                                <label class="col-form-label" for="txtDate">【掲載開日】（必須）</label>
                                <div class="row">
                                    <date-picker v-model="dateRange" range :shortcuts="shortcuts" :lang= "ja" ></date-picker>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label" for="description">【掲載内容】</label>
                                <!-- <vue-editor v-model="activeCenter.content" id="description" required></vue-editor> -->
                                <wysiwyg v-model="activeCenter.content" />
                            </div>
                            <div class="form-group">
                                <label for="inputFile">【添付ファイル】</label>
                                <input class="form-control-file" id="inputFile" aria-describedby="fileHelp" type="file">
                            </div>
                            【非アクティブ化する】
                            <div class="row">
                                <toggle-button   v-model="activeCenter.dea" :value="false" :color="color" :sync="true" :labels="true"/> 
                            </div>  
                            <button type="button" class="btn btn-outline-primary" onclick="history.back()">戻る</button>
                            <button type="submit" class="btn btn-outline-primary">確認に進む</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import DatePicker from "vue2-datepicker"
    import { VueEditor } from 'vue2-editor'
    

    export default {
        components: { DatePicker, VueEditor },
        name: "company",
        data() {
            return {
                activeCenters: [],
                dateRange: [],
                activeCenter: {
                    id: "",
                    title: "",
                    start_date: !!this.dateRange ?  this.dateRange[0]: "",
                    end_date: !!this.dateRange ?  this.dateRange[1]: "",
                    content: "",
                    file: "4245",
                    deactivate: 0,
                    created_by: 1,
                    updated_by: 1
                },
                id: "", 
                pagination: {},
                edit: false,
                ja: {
                    days: ['太陽', '月', '火', '水', '木', '金', '土'],
                    months: ['一月 ', '二月 ', '三月', '四月 ', '五月', '六月', '七月 ', '八月', '九月', '十月', '十一月', '十二月'],
                    pickers: ['次の7日間', '次の30日間', '前の7日間', '前の30日間'],
                    placeholder: {
                        date: '日付を選択',
                        dateRange: '期間を選択'
                    }
                },
                shortcuts: [
                    {
                        text: "今日",
                        start: new Date(),
                        end: new Date()
                    }
                ],
                dateFormat: 'yyyy/MM/dd',
                color : '#1C89E7'
            };
        },

        created() {
            if (this.$route.params.id != undefined)
                this.editActiveCenter(this.$route.params.id)
        },

        methods: {
            fetchActiveCenters(page_url) {
                let vm = this
                page_url = page_url || "/api/active-centers"
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.activeCenters = res.data
                    console.log(this.activeCenters)
                    vm.makePagination(res.meta, res.links)
                })
                .catch(err => console.log(err))
            },
            makePagination(meta, links) {
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev
                }

                this.pagination = pagination
            },
            deleteActiveCenter(id) {
                if (confirm("Are You Sure?")) {
                    fetch(`api/active-center/${id}`, {
                        method: "delete"
                    })
                    .then(res => res.json())
                    .then(data => {
                        alert("activeCenter Removed")
                        this.fetchactiveCenters();
                    })
                    .catch(err => console.log(err))
                }
            },
            addActiveCenter() {
                this.activeCenter.start_date = !!this.dateRange ?  this.dateRange[0]: ""
                this.activeCenter.end_date = !!this.dateRange ?  this.dateRange[1]: ""

                if (this.edit === false) {
                    console.log(this.activeCenter)
                    // Add
                    fetch("api/active-center", {
                        method: "post",
                        body: JSON.stringify(this.activeCenter),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.activeCenter.title = ""
                        this.activeCenter.start_date = ""
                        this.activeCenter.end_date = ""
                        this.activeCenter.content = ""
                        this.activeCenter.file = ""
                        this.activeCenter.created_by = ""
                        this.activeCenter.updated_by = ""
                        
                        alert("Active Center Added")
                        this.$router.push({
                            name: 'activeCenterList'
                        })
                    })
                    .catch(err => console.log(err))
                } else {
                    // Update
                    fetch("api/active-center", {
                        method: "put",
                        body: JSON.stringify(this.activeCenter),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.activeCenter.name = ""

                        alert("Active Center Updated")
                        this.$router.push({
                            name: 'activeCenterList'
                        });
                    })
                    .catch(err => console.log(err))
                }
            },
            editActiveCenter(activeCenter) {
                this.edit = true
                this.activeCenter.id = activeCenter.id
                this.activeCenter.name = activeCenter.name
                this.activeCenter.comments = activeCenter.comments
                this.activeCenter.update_by = block.update_by
            }
        }
    };
</script>