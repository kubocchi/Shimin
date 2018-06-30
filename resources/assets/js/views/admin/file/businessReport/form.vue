<template>
    <div>
        <h4>
            <span>
                <i class="fas fa-file"></i>
            </span>事業報告 登録画面</h4>
        <hr>
        
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="bs-component">
                    <form @submit.prevent="submitClicked">
                        <fieldset>
                            <div class="row">
                                <div class="form-group col-sm-12 col-lg-6">
                                   <label class="col-form-label" for="subject">【年度】（必須）</label>
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
                                    <span class="is-danger">{{ errors.first('year') }}</span>
                                </div>
                                
                                <div class="form-group col-sm-12 col-lg-6">
                                   <label class="col-form-label" for="subject">【事業名】（必須）</label>
                                    <multiselect 
                                        v-model="selectedBusiness" 
                                        :options="businesses" 
                                        @select="onSelectBusiness"  
                                        track-by="id" 
                                        label="name" 
                                        placeholder="選んでください" 
                                        selectLabel="クリックして選択する" 
                                        deselectLabel="クリックして選択を解除する" 
                                        selectedLabel="選ばれた" 
                                        v-validate="'required'" 
                                        name="business" 
                                        data-vv-as="事業名">
                                    </multiselect>
                                    <span class="is-danger">{{ errors.first('business') }}</span>
                                </div>
                            </div>

                            <div class="col-lg-12 form-group">
                               	<label for="contents">【説明】</label>
                                <wysiwyg v-model="businessReport.detail" type="text"/>
                            </div>

                             <div class="col-lg-12 form-group">
                                <label for="inputFile">【公開ファイル】（必須）</label>
                                <div class="file-upload">
                                    <div class="form-group">
                                        <label class="btn btn-outline-primary btn-sm" for="attachments">
                                             <input type="file" id="attachments" multiple="multiple" style="display: none" @change="uploadFieldChange"  
                                             accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.zip,application/zip,application/x-zip,application/x-zip-compressed">
                                            参照
                                        </label>

                                        <div class="row">
                                            <span class="is-danger" :hidden="attachments.length > 0 ? true : false">添付ファイルが指定されていません</span>
                                        </div>
                                        
                                        <div class="form-group files">
                                            <div class="attachment-holder animated fadeIn" v-cloak v-bind:key="attachment.id" v-for="attachment in attachments"> 
                                                <div class="form-group">
                                                    <button class="btn btn-outline-danger btn-sm" @click.prevent="removeAttachment(attachment)">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                    <span class="label label-primary">{{ attachment.name + ' (' + Number((attachment.size / 1024 / 1024).toFixed(1)) + 'MB)'}}</span> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <router-link :to="{ name: 'businessReportList' }">
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
                                        </span> 事業報告 登録画面
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
                                                                    <label>【件名】</label>
                                                                    <p>{{selectedYear? selectedYear.year: ''}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【説明】</label>
                                                                    <p>{{selectedBusiness? selectedBusiness.name : ''}}</p>
                                                                </div>
                                                                <div>
                                                                    <label>【説明】</label>
                                                                    <p v-html="businessReport.detail"></p>
                                                                </div>

                                                                <div>
                                                                    <label>【添付ファイル】</label>
                                                                    <div class="form-group files">
                                                                        <div class="attachment-holder animated fadeIn" v-cloak v-bind:key="attachment.id" v-for="attachment in attachments"> 
                                                                            <ul class="form-group">
                                                                                <li class="label label-primary">{{ attachment.name + ' (' + Number((attachment.size / 1024 / 1024).toFixed(1)) + 'MB)'}}</li> 
                                                                            </ul>
                                                                        </div>
                                                                    </div>
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
                            <div class="modal fade" id="progressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCentersubject" aria-hidden="true">
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
    import Multiselect from "vue-multiselect"

    export default {
        components: { Multiselect, VueDatepickerLocal },
        data() {
            return {
                businessReport: {
                    id: null,
                    year_id: null,
                    business_id: null,
                    detail: null,
                    file: null,
                    deactivate: false,
                    created_by: 1,
                    updated_by: 1
                },
                id: "",
                pagination: {},
                edit: false,
                copy: false,
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
                width:'0%',
                selectedBusiness:null,
                selectedYear:null,
                years: [],
                businesses: []
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
            else if(this.$route.params.requestType === 'copy')
                this.copy = true

            this.fetchYear()
            
        },

        methods: {
            // Add new, sends model to API
            addbusinessReport() {
                this.businessReport.file = this.currentAddedFileIs.join(',')

                let self = this
                console.log(this.businessReport)

                if (this.edit === false) {
                    // Add
                    let loader = this.$loading.show()
                    fetch("api/business-report", {
                        method: "post",
                        body: JSON.stringify(this.businessReport),
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
                                name: 'businessReportList'
                            })
                        });
                    })
                    .catch(err => console.log(err))
                } else {

                    // Update
                    let loader = this.$loading.show()
                    fetch("api/business-report", {
                        method: "put",
                        body: JSON.stringify(this.businessReport),
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
                                name: 'businessReportList'
                            })
                        });
                    })
                    .catch(err => console.log(err))
                }
            },

            // Edit new, sends model to API
            fillFormWithRecievedModel(businessReport) {
                console.log(businessReport)
                this.pullAttachments(businessReport);

                this.businessReport.id = businessReport.id
                this.businessReport.year_id = businessReport.year.id
                this.businessReport.business_id = businessReport.business.id
                this.businessReport.detail = businessReport.detail
                this.businessReport.file = businessReport.file
                this.businessReport.deactivate = businessReport.deactivate == 1 ? true:false
                this.businessReport.created_by = businessReport.created_by
                this.businessReport.updated_by = businessReport.updated_by

                // For Files
                if(businessReport.file)
                    this.currentAddedFileIs = businessReport.file.split(',')
            },

            // Analyzing attachmet file size
            getAttachmentSize() {
                this.upload_size = 0; // Reset to beginningƒ
                this.attachments.map((item) => { this.upload_size += parseInt(item.size); });
                this.upload_size = Number((this.upload_size).toFixed(1));
                this.$forceUpdate();
            },

            // Preparing files 
            prepareFields() {
                for (var i = this.attachments.length - 1; i >= 0; i--) {
                    console.log(this.attachments[i].category_id);
                    this.uploadedData.append("attachments[][0]", this.attachments[i]);
                    this.uploadedData.append("attachments[][1]", this.attachments[i].category_id);
                }

                for (var i = this.attachment_labels.length - 1; i >= 0; i--) {
                    this.uploadedData.append("attachment_labels[]", JSON.stringify(this.attachment_labels[i]));
                }
            },

            // Removing attachment on button click
            removeAttachment(attachment) {
                console.log(attachment)
                if (attachment.id)
                    this.tempRemovedFileIds.push(attachment.id)

                this.attachments.splice(this.attachments.indexOf(attachment), 1);
                this.getAttachmentSize();
            },

            // This function will be called every time you add a file
            uploadFieldChange(e) {
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;

                for (var i = files.length - 1; i >= 0; i--) {
                    this.attachments.push(files[i]);
                }

                // Reset the form to avoid copying these files multiple times into this.attachments
                document.getElementById("attachments").value = []
                console.log(attachments);
            },

            // Adding attachment, Sends request to Attachment API
            addAttachment() {
                this.prepareFields()

                var config = {
                    headers: { 'Content-Type': 'multipart/form-data' },
                    onUploadProgress: function (progressEvent) {
                        this.percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total)
                        console.log(this.percentCompleted)
                        this.width = this.percentCompleted + '%'
                        this.$forceUpdate()
                    }.bind(this)
                };

                //Make HTTP request to store announcement
                $("#progressModal").modal({ backdrop: 'static' }, 'show');
                axios.post('/api/attachments/store', this.uploadedData, config)
                    .then(function (response) {
                        console.log(response);
                        if (response.data.success) {
                            console.log('Successfull upload')
                            this.currentAddedFileIs.push(response.data.data)
                            this.resetData()
                            this.addbusinessReport()
                            $("#progressModal").modal('hide')
                        } else {
                            console.log('Unsuccessful Upload')
                        }
                    }
                        .bind(this)) // Make sure we bind Vue Component object to this funtion so we get a handle of it in order to call its other methods
                    .catch(function (error) {
                        console.log('Attachment catch', error)
                    });
                console.log(attachments)
            },

            // We want to clear the FormData object on every upload so we can re-calculate new files again.
            // Keep in mind that we can delete files as well so in the future we will need to keep track of that as well
            resetData() {
                this.uploadedData = new FormData(); // Reset it completely
                this.attachments = [];
            },

            // Removing attachment form database and server, sends file id to attachment remove API
            removeServerAttachment(attachment_id) {
                let data = {
                    params:
                    {
                        attachment_id: attachment_id
                    }
                };

                // Make HTTP request to store announcement
                axios.delete('/api/attachments/', data)
                    .then(function (response) {
                        console.log(response)
                        if (response.data.success) {
                            this.getAttachmentSize()
                        } else {
                            console.log(response.data.errors)
                        }

                    }.bind(this)) // Make sure we bind Vue Component object to this funtion so we get a handle of it in order to call its other methods
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            // Pull required attachmets
            pullAttachments(object) {
                // Make HTTP request to store announcement
                axios.get(`api/asset/attachments/${object.file}`).then(function (response) {
                    console.log(response);
                    if (response.data.success) {
                        this.attachments = response.data.data;
                        console.log('Attachments: ', this.attachments)
                        this.getAttachmentSize()
                    } else {
                        console.log(response.data.errors)
                    }

                }.bind(this)) // Make sure we bind Vue Component object to this funtion so we get a handle of it in order to call its other methods
                    .catch(function (error) {
                        console.log(error);
                    });

            },


            // Final submisison clicked for form data
            submitClicked(){
                $("#confirmationModal").modal('hide')
                if(this.tempRemovedFileIds.length){
                    this.tempRemovedFileIds.forEach(id => {
                        this.removeServerAttachment(id)
                        this.currentAddedFileIs.filter(item => item !== id)
                    })
                }

                if(this.attachments.length)
                    this.addAttachment()
                else
                    this.addbusinessReport()
            },

            // Checking for validation and reconfirm opening modal
            confirm(){
                this.$validator.validate().then(result => {
                    if(this.attachments.length == 0){
                        return
                    }
                    if (!result) {
                        console.log('true')
                    }
                    else{
                        $("#confirmationModal").modal('show')
                    }
                });
            },
            onSelectYear(selectedOption, id) {
                if(selectedOption){
                    this.businessReport.year_id = selectedOption.id
                    console.log(selectedOption.id)
                    this.selectedBusiness = null
                    this.fetchBusiness()
                }
            },
            onSelectBusiness(selectedOption, id) {
                if(selectedOption){
                    this.businessReport.business_id = selectedOption.id
                    console.log(selectedOption.id)
                }
            },
            fetchYear(page_url) {
                let loader = this.$loading.show();
                let vm = this;
                page_url = page_url || "/api/years";

                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.years = res.data
                        if(this.edit || this.copy){
                            this.selectedYear = this.years.find(x => x.id === this.businessReport.year_id)
                            this.fetchBusiness()
                        }
                        console.log(this.years)
                        loader.hide()
                    })
                    .catch(err => console.log(err))
            },
            fetchBusiness(page_url) {
                let loader = this.$loading.show();
                let vm = this;
                page_url = page_url || `/api/business/year/${this.businessReport.year_id}`;

                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        this.businesses = res.data;
                        if(this.edit || this.copy){
                            this.selectedBusiness = this.businesses.find(x => x.id === this.businessReport.business_id)
                        }
                        
                        console.log(this.businesses);
                        loader.hide()
                    })
                    .catch(err => console.log(err))
            },
        }
    };
</script>