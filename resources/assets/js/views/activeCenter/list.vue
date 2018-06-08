<template>
    <div >
        <h4>
            <span>
                <i class="fas fa-dove"></i>
            </span> 宮崎市民活動センターからのお知らせ 情報一覧画面</h4>
        <hr>
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="bs-component">
                    <div class="row">
                        <div class="col-md-2">
                            <router-link :to="{ name: 'activeCenterForm' }">
                                <button class="btn btn-primary btn-lg btn-block">新規登録</button>
                            </router-link> 
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="form-group col-md-2 mb-4">
                        <select class="form-control" id="attribute_shikatsu">
                            <option>すべて</option>
                            <option>公開中</option>
                            <option>登録作業中</option>
                            <option>終了</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4 offset-sm-6">
                        <div class="input-group">
                            <input type="text" class="form-control">
                            <span class="input-group-btn">
                                <button class="btn btn-outline-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row col-lg-12 table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr class="table-primary">
                                <th scope="col">No.</th>
                                <th scope="col">件名</th>
                                <th scope="col">更新日</th>
                                <th scope="col">複製</th>
                                <th scope="col">変更</th>
                                <th scope="col">削除</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>CAPおとなワークショップ</td>
                                <td>xxxx/xx/xx</td>
                                <td>
                                    <a class="btn btn-outline-primary btn-block" href="#" role="button">複製</a>
                                </td>
                                <td>
                                    <a class="btn btn-outline-success btn-block" href="#" role="button">変更</a>
                                </td>
                                <td>
                                    <a class="btn btn-outline-danger btn-block" href="#" role="button">削除</a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>発達障がいのある方や、コミュニケーションに困り感のある方のための就職応援講座</td>
                                <td>xxxx/xx/xx</td>
                                <td>
                                    <a class="btn btn-outline-primary btn-block" href="#" role="button">複製</a>
                                </td>
                                <td>
                                    <a class="btn btn-outline-success btn-block" href="#" role="button">変更</a>
                                </td>
                                <td>
                                    <a class="btn btn-outline-danger btn-block" href="#" role="button">削除</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <nav aria-label="Page navigation shikatsu">
                    <ul class="pagination justify-content-end">
                        <li class="page-item">
                            <a class="page-link" href="#">前へ</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">次へ</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>