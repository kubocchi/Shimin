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
                    <form @submit.prevent="submitClicked">
                        <fieldset>
                            <div class="form-group">
                                <label class="col-form-label" for="subject">【件名】（必須）</label>
                                <input class="form-control" v-model="activeCenter.title" placeholder="件名" id="subject" type="text">
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
                                <wysiwyg v-model="activeCenter.content" required/>
                            </div>
                            【非アクティブ化する】
                            <div class="row">
                                <toggle-button v-model="activeCenter.deactivate" :value="false" :color="color" :sync="true" :labels="true" />
                            </div>
                             <div class="form-group">
                                <label for="inputFile">【添付ファイル】</label>
                                <!-- <input class="form-control-file" id="inputFile" aria-describedby="fileHelp" type="file"> -->
                                <div class="file-upload">
                                    <div class="form-group">
                                        <input type="file" multiple="multiple" id="attachments" @change="uploadFieldChange">
                                        <div class="form-group files">
                                            <div class="attachment-holder animated fadeIn" v-cloak v-for="(attachment, index) in attachments"> 
                                                <div class="form-group">
                                                    <span class="label label-primary">{{ attachment.name + ' (' + Number((attachment.size / 1024 / 1024).toFixed(1)) + 'MB)'}}</span> 
                                                    <button class="btn btn-outline-danger" @click.prevent="removeAttachment(attachment)">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                    file: "",
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
                },
                // You can store all your files here
                attachments: [],
                attachment_labels: [], // List of old uploaded files coming from the server
                categories: [],
                // Each file will need to be sent as FormData element
                uploadedData: new FormData(),
                percentCompleted: 0,
                tempRemovedFileIds: [],
                currentAddedFileIs: []
            };
        },

        created() {
            if (this.$route.params.id != undefined)
                this.editActiveCenter(this.$route.params.id)
        },

        methods: {
            addActiveCenter() {
                this.activeCenter.file = this.currentAddedFileIs.join(',')

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
                }
            },
            editActiveCenter(activeCenter) {
                console.log(activeCenter)
                this.pullAttachments(activeCenter);
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

                // For Files
                this.currentAddedFileIs = activeCenter.file.split(',')
            },
            
            selectCategory(attachment, category_id) {
                attachment.category_id = category_id;
                console.log(attachment);
                this.$forceUpdate();
            },

            getAttachmentSize() {
                this.upload_size = 0; // Reset to beginningƒ
                this.attachments.map((item) => { this.upload_size += parseInt(item.size); });
                this.upload_size = Number((this.upload_size).toFixed(1));
                this.$forceUpdate();
            },

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

            removeAttachment(attachment) {
                console.log(attachment)

                if(attachment.id)
                    this.tempRemovedFileIds.push(attachment.id)
                    //this.removeServerAttachment(attachment.id)
                //var hasApple = this.activeCenter.file.indexOf('apple') != -1;

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
                document.getElementById("attachments").value = [];
                console.log(attachments);
            },

            validate() {
                let validation = []
                if(this.activeCenter.title.trim() === ''){
                    validation.push('件名')
                   
                }
                if(this.activeCenter.content.trim() === ''){
                    validation.push('掲載開日')
                }

                if(validation.length){
                     this.$swal({
                        title: '次のフィールドは空ではありません!',
                        text: validation.join('\n'),
                        animation: false,
                        customClass: 'animated tada',
                        confirmButtonText : 'よし',
                        width: '800px'
                    })
                    return false
                }
                return true;
            },

            addAttachment() {
                this.prepareFields()

                var config = {
                    headers: { 'Content-Type': 'multipart/form-data' } ,
                    onUploadProgress: function(progressEvent) {
                        this.percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                        console.log(this.percentCompleted);
                        this.$forceUpdate();
                    }.bind(this)
                };

                //Make HTTP request to store announcement
                let loader = this.$loading.show()
                axios.post('/api/attachments/store', this.uploadedData, config)
                .then(function (response) {
                    console.log(response);
                    if (response.data.success) {
                        console.log('Successfull upload')
                        this.currentAddedFileIs.push(response.data.data)
                        this.resetData()
                        this.addActiveCenter()
                        loader.hide()
                    } else {
                        console.log('Unsuccessful Upload')
                    }
                }
                .bind(this)) // Make sure we bind Vue Component object to this funtion so we get a handle of it in order to call its other methods
                .catch(function (error) {
                    console.log('Attachment catch', error);
                });
                console.log(attachments)
            },

            // We want to clear the FormData object on every upload so we can re-calculate new files again.
            // Keep in mind that we can delete files as well so in the future we will need to keep track of that as well
            resetData() {
                this.uploadedData = new FormData(); // Reset it completely
                this.attachments = [];
            },

            removeServerAttachment(attachment_id){
                let data = {
                    params: 
                    {
                        attachment_id: attachment_id
                    }
                };

                // Make HTTP request to store announcement
                axios.delete('/api/attachments/', data)
                .then(function (response) {
                    console.log(response);
                    if (response.data.success) {
                        this.getAttachmentSize();
                    } else {
                        console.log(response.data.errors);
                    }
                    
                }.bind(this)) // Make sure we bind Vue Component object to this funtion so we get a handle of it in order to call its other methods
                .catch(function (error) {
                    console.log(error);
                });
            },

            pullAttachments(activeCenter) {
                // Make HTTP request to store announcement
                axios.get(`api/asset/attachments/${activeCenter.file}`).then(function (response) {
                    console.log(response);
                    if (response.data.success) {
                        this.attachments = response.data.data;
                        console.log('Attachments: ', this.attachments);
                        this.getAttachmentSize();
                    } else {
                        console.log(response.data.errors);
                    }
                    
                }.bind(this)) // Make sure we bind Vue Component object to this funtion so we get a handle of it in order to call its other methods
                .catch(function (error) {
                    console.log(error);
                });

            },

            getAttachmentSize() {
                this.upload_size = 0; // Reset to beginningƒ
                this.attachments.map((item) => { this.upload_size += parseInt(item.size); });
                this.upload_size = Number((this.upload_size).toFixed(1));
                this.$forceUpdate();
            },

            removeAttachments(attachment) {
                //this.removeServerAttachment(attachment.id);
                this.attachments.splice(this.attachments.indexOf(attachment), 1);
                this.getAttachmentSize();
            },

            submitClicked(){
                if (!this.validate()) 
                    return

                if(this.tempRemovedFileIds.length){
                    this.tempRemovedFileIds.forEach(id => {
                        this.removeServerAttachment(id)
                        this.currentAddedFileIs.filter(item => item !== id)
                    })
                }

                if(this.attachments.length)
                    this.addAttachment()

               
            }
        }
    };
</script>