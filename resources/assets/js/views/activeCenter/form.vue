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
                                    <vue-datepicker-local  v-model="range" :local="local" :format="dateFormat"></vue-datepicker-local>
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
                                <toggle-button v-model="activeCenter.deactivate" :value="false" :color="color" :sync="true" :labels="true" />
                            </div>
                             <router-link :to="{ name: 'activeCenterList' }">
                                <button class="btn btn-outline-primary">戻る</button>
                            </router-link> 
                            <button type="submit" class="btn btn-outline-primary">確認に進む</button>
                    </fieldset>
                </form>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import { VueEditor } from 'vue2-editor'
    import VueDatepickerLocal from 'vue-datepicker-local'
    import moment from 'moment'


    export default {
        components: { VueEditor, VueDatepickerLocal },
        name: "company",
        data() {
            return {
                activeCenters: [],
                dateRange: [],
                activeCenter: {
                    id: "",
                    title: "",
                    start_date: !!this.range ? this.dateRange[0] : "",
                    end_date: !!this.range ? this.dateRange[1] : "",
                    content: "",
                    file: "4245",
                    deactivate: false,
                    created_by: 1,
                    updated_by: 1
                },
                id: "",
                pagination: {},
                edit: false,
                dateFormat: 'YYYY-MM-DD',
                color: '#1C89E7',
                time: new Date(),
                range: [new Date(), new Date()],
                emptyTime: '',
                emptyRange: [],
                local: {
                    dow: 0, // Sunday is the first day of the week
                    hourTip: 'Select Hour', // tip of select hour
                    minuteTip: 'Select Minute', // tip of select minute
                    secondTip: 'Select Second', // tip of select second
                    yearSuffix: '', // suffix of head year
                    monthsHead: '一月_二月_三月_四月_五月_六月_七月_八月_九月_十月_十一月_十二月'.split('_'), // months of head
                    months: '一_二_三_四_五_六_七_八_九_十_十一_十二'.split('_'), // months of panel
                    weeks: '日_月_火_水_木_金_土'.split('_'), // weeks,
                    cancelTip: 'cancel',
                    submitTip: 'confirm'
                }
            };
        },

        created() {
            if (this.$route.params.id != undefined)
                this.editActiveCenter(this.$route.params.id)

            this.$swal('Hello Vue world!!!');
        },

        methods: {
            addActiveCenter() {
                let self = this
                console.log(this.activeCenter)
                this.activeCenter.start_date = !!this.range ? moment(String(this.range[0])).format("YYYY-MM-DD") : ""
                this.activeCenter.end_date = !!this.range ? moment(String(this.range[1])).format("YYYY-MM-DD") : ""

                if (this.edit === false) {
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
                        self.$swal({
                            title: "成功!",
                            text: "活動センターが追加されました!",
                            type: "success",
                            confirmButtonText : 'よし'
                        })
                        .then(function() {
                            self.$router.push({
                                name: 'activeCenterList'
                            })
                        });
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

                        alert("Active Center Updated")
                        this.$router.push({
                            name: 'activeCenterList'
                        });
                    })
                    .catch(err => console.log(err))
                }
            },
            editActiveCenter(activeCenter) {
                console.log(activeCenter)
                this.edit = true
                this.activeCenter.id = activeCenter.id
                this.activeCenter.title = activeCenter.title
                this.activeCenter.start_date = activeCenter.start_date
                this.activeCenter.end_date = activeCenter.end_date
                this.activeCenter.content = activeCenter.content
                this.activeCenter.file = activeCenter.file
                this.activeCenter.deactivate = !! activeCenter.deactivate==1 ? true:false
                this.activeCenter.created_by = activeCenter.created_by
                this.activeCenter.updated_by = activeCenter.updated_by
            }
        }
    };
</script>