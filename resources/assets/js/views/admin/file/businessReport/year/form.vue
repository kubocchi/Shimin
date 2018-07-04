<template>
    <div>
        <h4>
            <span>
                <i class="fas fa-dove"></i>
            </span>事業報告  年度登録画面</h4>
        <hr>
        
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="bs-component">
                    <form @submit.prevent="submitClicked">
                        <fieldset>
                            <div class="col-lg-12 form-group">
                                <label class="col-form-label" for="subject">【年度】（必須）</label>
                                <input class="form-control" v-model="year.year" placeholder="年度" id="subject" v-validate="'required'" name="year" data-vv-as="件名" type="text">
                                <span class="is-danger">{{ errors.first('year') }}</span>
                            </div>

                            <router-link :to="{ name: 'yearList' }">
                                <button class="btn btn-outline-primary">戻る</button>
                            </router-link> 


                            <button type="button" class="btn btn-primary" @click="confirm">
                                確認に進む
                            </button>   

                            <!-- Confirmation Modal -->
                            <div class="modal" id="confirmationModal">
                                <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                    <h4 class="modal-subject">
                                        <span>
                                            <i class="fas fa-dove"></i>
                                        </span>事業報告 年度登録確認画面
                                    </h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <div class="row mt-4">
                                            <div class="col-lg-12">
                                                <div class="bs-component">
                                                    <div style="overflow:hidden;">
                                                        <form action="" method="post">
                                                            <p>登録内容を確認し問題がなければ登録ボタンを押してください。</p>
                                                            <div>
                                                                <div>
                                                                    <label>【年度】</label>
                                                                    <p>{{year.year}}</p>
                                                                </div>
                                                                
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">戻る</button>
                                        <button type="button" class="btn btn-outline-primary" @click="submitClicked" >登録</button>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <!--Progress Modal -->
                            <div class="modal" id="progressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCentersubject" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" 
                                                aria-valuemin="0" aria-valuemax="100" v-bind:style="{ width: computedWidth }"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </fieldset>
                </form>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import VueDatepickerLocal from 'vue-datepicker-local'
    import moment from 'moment'

    export default {
        components: { VueDatepickerLocal },
        data() {
            return {
                year: {
                    id: "",
                    year: "",
                    deactivate: false,
                   updated_by: this.$store.state.user != null? this.$store.state.user.id : 0,
                    created_by: this.$store.state.user != null? this.$store.state.user.id : 0
                },
                id: "",
                pagination: {},
                edit: false,
                dateFormat: 'YYYY-MM-DD',
                switchColorDeactivate: '#DC3545',
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
                },
                // You can store all your files here
                attachments: [],
                attachment_labels: [], // List of old uploaded files coming from the server
                // Each file will need to be sent as FormData element
                uploadedData: new FormData(),
                percentCompleted: 0,
                tempRemovedFileIds: [],
                currentAddedFileIs: [],
                width:'0%'
            };
        },
        computed: {
            computedWidth: function () {
                return this.width;
            }
        },

        created() {
            console.log(this.$route.params)
            if (this.$route.params.model)
                this.fillFormWithRecievedModel(this.$route.params.model)
            
            if(this.$route.params.requestType === 'edit')
                this.edit = true
        },

        methods: {
            // Add new, sends model to API
            addYear() {
                this.year.file = this.currentAddedFileIs.join(',')

                let self = this
                console.log(this.year)

                if (this.edit === false) {
                    // Add
                    let loader = this.$loading.show()
                    fetch("/api/year", {
                        method: "post",
                        body: JSON.stringify(this.year),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        loader.hide()
                        self.$swal({
                            title: "登録完了!",
                            text: "登録が完了しました!",
                            type: "success",
                            confirmButtonText : 'OK'
                        })
                        .then(function() {
                            self.$router.push({
                                name: 'yearList'
                            })
                        });
                    })
                    .catch(err => console.log(err))
                } else {

                    // Update
                    let loader = this.$loading.show()
                    fetch("/api/year", {
                        method: "put",
                        body: JSON.stringify(this.year),
                        headers: {
                            "content-type": "application/json"
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        loader.hide()
                        self.$swal({
                            title: "成功!",
                            text: "活動センターが追加されました!",
                            type: "success",
                            confirmButtonText : 'OK'
                        })
                        .then(function() {
                            self.$router.push({
                                name: 'yearList'
                            })
                        });
                    })
                    .catch(err => console.log(err))
                }
            },

            // Edit new, sends model to API
            fillFormWithRecievedModel(year) {

                this.year.id = year.id
                this.year.year = year.year
                this.year.deactivate = !! year.deactivate == 1 ? true:false
                this.year.created_by = year.created_by
                this.year.updated_by = year.updated_by

                // For Files
                if(year.file)
                    this.currentAddedFileIs = year.file.split(',')
            },

            

            // Final submisison clicked for form data
            submitClicked(){
                $("#confirmationModal").modal('hide')
                this.addYear()
            },

            // Checking for validation and reconfirm opening modal
            confirm(){
                this.$validator.validate().then(result => {
                    if (!result) {
                        console.log('true')
                    }
                    else{
                        this.year.start_date = !!this.range ? this.range[0].toISOString().slice(0,10) : ""
                        this.year.end_date = !!this.range ? this.range[1].toISOString().slice(0,10) : ""
                        $("#confirmationModal").modal('show')
                    }
                });
            }
        }
    };
</script>