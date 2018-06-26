<template>
    <div>
        <!-- <Spinner name="pulse" color="#2E92E8"/> -->
       <h4><span><i class="fas fa-feather"></i></span> 団体情報 一覧画面</h4>
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
                        <select class="form-control" id="active_classification">
                            <option> 区分 </option>
                            <option> センター </option>
                            <option> 社協 </option>
                            <option> 佐土原 </option>
                            <option> 高岡 </option>
                            <option> 田野 </option>
                            <option> 清武 </option>
                        </select>
                    </div>
                    <div class="form-group col-md-2 mb-4">
                        <select class="form-control" id="active_status">
                            <option> ステータス </option>
                            <option> 公開 </option>
                            <option> 非公開 </option>
                        </select>
                    </div>
                    <div class="form-group col-md-2 mb-4">
                        <select class="form-control" id="active_type">
                            <option> 種別 </option>
                            <option> 団体 </option>
                            <option> 個人 </option>
                        </select>
                    </div>
                    <div class="form-group col-md-2 mb-4">
                        <select class="form-control" id="active_category">
                            <option> 活動分類 </option>
                            <option value="100"> 保健・医療</option>
                            <option value="200"> 高齢者福祉 </option>
                            <option value="300"> 障害者福祉 </option>
                            <option value="400"> 児童福祉 </option>
                            <option value="500"> 社会教育 </option>
                            <option value="600"> まちづくり </option>
                            <option value="700"> 観光 </option>
                            <option value="800"> 農山漁村 </option>
                            <option value="900"> 文化芸術 </option>
                            <option value="1000"> 環境保全 </option>
                            <option value="1100"> 災害救援 </option>
                            <option value="1200">地域安全 </option>
                            <option value="1300"> 人権・平和 </option>
                            <option value="1400"> 国際協力 </option>
                            <option value="1500"> 男女共同 </option>
                            <option value="1600"> 子供育成</option>
                            <option value="1700"> 情報社会 </option>
                            <option value="1800"> 科学技術 </option>
                            <option value="1900"> 経済活動 </option>
                            <option value="2000"> 職業・雇用 </option>
                            <option value="2100"> 消費者保護</option>
                            <option value="2200"> NPO支援 </option>
                            <option value="2300"> その他区分 </option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="input-group">
                            <input class="form-control" type="text">
                            <span class="input-group-btn">
                            <button class="btn btn-outline-primary" type="submit"><span class="input-group-btn"><i class="fas fa-search"></i></span></button>
                            </span> 　 <span class="input-group-btn">
                            <button class="btn btn-outline-primary" type="submit"><span class="input-group-btn"><i class="fas fa-times"></i></span></button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row col-lg-12 table-responsive">
                    <table class="table table-sm list_table">
                        <thead>
                            <tr class="table-primary">
                                <th class="col-xs-1" scope="col">No.</th>
                                <th class="col-xs-1 wide_d" scope="col">区分</th>
                                <th class="col-xs-1 wide_d" scope="col">ステータス</th>
                                <th class="col-xs-1 wide_d" scope="col">種別</th>
                                <th class="col-xs-2 wide_d" scope="col">活動分類</th>
                                <th class="col-xs-4 wide_s" scope="col">団体名</th>
                                <th class="col-xs-1" scope="col">変更</th>
                                <th class="col-xs-1" scope="col">削除</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>センター</td>
                                <td>公開</td>
                                <td>団体</td>
                                <td>まちづくり</td>
                                <td>まちづくり団体sample0000001</td>
                                <td><a class="btn btn-outline-success btn-block" href="#" role="button">変更</a></td>
                                <td><a class="btn btn-outline-danger btn-block" href="#" role="button">削除</a></td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>社協</td>
                                <td>非公開</td>
                                <td>個人</td>
                                <td>国際協力</td>
                                <td>パーソナルサンプル登録</td>
                                <td><a class="btn btn-outline-success btn-block" href="#" role="button">変更</a></td>
                                <td><a class="btn btn-outline-danger btn-block" href="#" role="button">削除</a></td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>佐土原</td>
                                <td>公開</td>
                                <td>団体</td>
                                <td>子どもの健全育成</td>
                                <td>子供の健全育成促進団体AAAA</td>
                                <td><a class="btn btn-outline-success btn-block" href="#" role="button">変更</a></td>
                                <td><a class="btn btn-outline-danger btn-block" href="#" role="button">削除</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="bs-component">
                    <div class="row">
                        <div class="col-md-2 mt-4"> <a class="btn btn-outline-primary  btn-block" href="#" role="button">CSV出力</a> </div>
                        <div class="col-md-2 mt-4 mb-4"> <a class="btn btn-outline-primary  btn-block" href="#" role="button">CSV入力</a> </div>
                    </div>
                </div>
                <nav aria-label="Page navigation shikatsu">
                    <ul class="pagination justify-content-end">
                        <li class="page-item"> <a class="page-link" href="#">前へ</a> </li>
                        <li class="page-item"> <a class="page-link" href="#">1</a> </li>
                        <li class="page-item"> <a class="page-link" href="#">2</a> </li>
                        <li class="page-item"> <a class="page-link" href="#">3</a> </li>
                        <li class="page-item"> <a class="page-link" href="#">次へ</a> </li>
                    </ul>
                </nav>
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
      variouses: [],
      pagination: {},
      edit: false,
      params: {
        search: "",
        group: null
      },
      selectedGroup: { id: null, label: "すべて" },
      groups: [
        { id: null, label: "すべて" },
        { id: 1, label: "市民活動団体登録・情報変更" },
        { id: 2, label: "個人ボランティア登録・情報変更・抹消" },
        { id: 3, label: "かわら版掲載申込書" },
        { id: 4, label: "各種申込用紙" }
      ]
    };
  },

  created() {
    this.fetchVarious();
  },

  methods: {
    // Pulling data from API, its a post request with search-term, type
    fetchVarious(page_url) {
      let loader = this.$loading.show();
      let vm = this;
      page_url = page_url || "/api/variouses";

      fetch(page_url, {
        method: "post",
        body: JSON.stringify(this.params),
        headers: {
          "content-type": "application/json"
        }
      })
        .then(res => res.json())
        .then(res => {
          this.variouses = res.data;
          console.log(this.variouses);
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
    deleteVarious(id) {
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
          fetch(`api/various/${id}`, {
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
              this.fetchVarious();
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
    onTypeChanged: function(e) {
      this.params.type = event.srcElement.value;
      this.fetchVarious();
    },

    // Clearing the user typed search term
    clearSearch() {
      this.params.search = "";
      this.fetchVarious();
    },
    onSelectGroup(selectedOption, id) {
      if (selectedOption) {
        console.log(selectedOption.id);
        this.params.group = selectedOption.id;
        this.fetchVarious();
      }
    }
  }
};
</script>