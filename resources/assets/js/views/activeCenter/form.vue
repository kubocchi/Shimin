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
                    <form action="" method="post">
                        <fieldset>
                            <div class="form-group">
                                <label class="col-form-label" for="subject">【件名】（必須）</label>
                                <input class="form-control" placeholder="件名" id="subject" type="text" required>
                            </div>
                            <div class="form-group"> 【掲載開始日】（必須）
                                <div class="form-check">
                                    <input name="publish_type" value="0" checked="" onclick="" type="radio" required> 承認後すぐに掲載
                                    <br>
                                    <input name="publish_type" value="1" onclick="" type="radio">
                                    <select name="publish_year" onchange="">
                                        <option value="2018" selected="">2018</option>
                                        <option value="2019">2019</option>
                                    </select>
                                    年
                                    <select name="publish_month" onchange="">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6" selected="">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                    月
                                    <select name="publish_day" onchange="">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5" selected="">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                    </select>
                                    日に自動掲載
                                </div>
                            </div>
                            <div class="form-group"> 【掲載終了日】（必須）
                                <div class="form-check">
                                    <input name="limit_type" value="0" checked="" onclick="" type="radio" required> 手動で消去
                                    <br>
                                    <input name="limit_type" value="1" onclick="" type="radio">
                                    <select name="limit_year" onchange="">
                                        <option value="2018" selected="">2018</option>
                                        <option value="2019">2019</option>
                                    </select>
                                    年
                                    <select name="limit_month" onchange="">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6" selected="">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                    月
                                    <select name="limit_day" onchange="">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6" selected="">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                    </select>
                                    日に自動消去
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="contents">【掲載内容】</label>
                                <textarea class="form-control" id="contents" rows="3" required></textarea>
                            </div>
                            <div class="form-group"> 【リンク(URL)の添付】
                                <br>
                                <label class="col-form-label" for="linkname">リンク名称</label>
                                <input class="form-control" placeholder="リンク名称" id="linkname" type="text">
                                <label class="col-form-label" for="linkurl">URL</label>
                                <input class="form-control" placeholder="リンクURL" id="linkurl" type="text">
                            </div>
                            <div class="form-group">
                                <label for="inputFile">【添付ファイル】</label>
                                <input class="form-control-file" id="inputFile" aria-describedby="fileHelp" type="file">
                            </div>
                            <!--						
						<fieldset class="form-group">
							<legend>Checkboxes</legend>
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" value="" checked="" type="checkbox">
									Option one is this and that—be sure to include why it's great </label>
							</div>
						</fieldset>-->
                            <button type="button" class="btn btn-outline-primary" onclick="history.back()">戻る</button>
                            <button type="submit" class="btn btn-outline-primary">確認に進む</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>