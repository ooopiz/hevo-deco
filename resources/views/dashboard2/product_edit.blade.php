@extends('dashboard2.layout')
@inject('categoryPresenter', 'App\Presenter\CategoryPresenter')
@inject('seriesPresenter', 'App\Presenter\SeriesPresenter')
@inject('commonPresenter', 'App\Presenter\CommonPresenter')

@section('title', '產品管理 | 日何百鐵')

@section('inner-css')
@endsection

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('dashboard2.include.validate')

            @if(isset($product))
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">產品編輯</h3>
                    </div>
                    <!-- form start -->
                    <form role="form" method="post" action="{{ URL_DASHBOARD2_PRODUCT_DO_SAVE }}">
                        <div class="box-body">
                            <div class="form-group" style="display: none;">
                                <label>id</label>
                                <input name="id" type="text" class="form-control" value="{{ $product->id }}">
                            </div>
                            <div class="form-group">
                                <label>SN</label>
                                <input type="text" class="form-control" disabled value="{{ 'SN' . str_pad($product->id, 5, '0', STR_PAD_LEFT) }}">
                            </div>
                            <div class="form-group">
                                <label>標題 / 產品名稱 (100)</label>
                                <input name="name" type="text" class="form-control" required value="{{ $product->name }}">
                            </div>
                            <div class="form-group">
                                <label>副標題 (100)</label>
                                <input name="subtitle" type="text" class="form-control" required value="{{ $product->subtitle }}">
                            </div>
                            <div class="form-group">
                                <label>類別</label>
                                <select name="category_ids" class="form-control">
                                    @foreach($categoryPresenter->categoryOptions() as $val)
                                        {{ $catSelect = ($val->id == $product->categoryLists[0]->category_id) ? true : false }}
                                        <option value="{{ $val->id }}" @if($catSelect) selected @endif>{{ $val->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>系列</label>
                                <select name="series_ids" class="form-control">
                                    @foreach($seriesPresenter->seriesOptions() as $val)
                                        {{ $serSelect = ($val->id == $product->seriesLists[0]->series_id) ? true : false }}
                                        <option value="{{ $val->id }}" @if($serSelect) selected @endif>{{ $val->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <label>長 / length (cm)</label>
                                    </div>
                                    <div class="col-xs-4">
                                        <label>寬 / width (cm)</label>
                                    </div>
                                    <div class="col-xs-4">
                                        <label>高 / height (cm)</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <input name="length" type="text" class="form-control" pattern="^\d*\.?\d+$" required value="{{ $product->length }}">
                                    </div>
                                    <div class="col-xs-4">
                                        <input name="width" type="text" class="form-control" pattern="^\d*\.?\d+$" required value="{{ $product->width }}">
                                    </div>
                                    <div class="col-xs-4">
                                        <input name="height" type="text" class="form-control" pattern="^\d*\.?\d+$" required value="{{ $product->height }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>顯示</label>
                                <select name="display" class="form-control">
                                    @foreach($commonPresenter->yesNoOptions() as $key => $val)
                                        {{ $displaySelect = ($key == $product->display) ? true : false }}
                                        <option value="{{ $key }}" @if($displaySelect) selected @endif>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>有效</label>
                                <select name="active" class="form-control">
                                    @foreach($commonPresenter->yesNoOptions() as $key => $val)
                                        {{ $activeSelect = ($key == $product->active) ? true : false }}
                                        <option value="{{ $key }}" @if($activeSelect) selected @endif>{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>描述 (500)</label>
                                <textarea name="content" class="form-control" rows="3" placeholder="Enter ...">{{ $product->content }}</textarea>
                            </div>
                        </div>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-footer text-center">
                            <button type="submit" class="btn btn-info">Save</button>
                        </div>
                    </form>
                    <!-- end form -->
                </div>
            @else
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">產品新增</h3>
                    </div>
                    <!-- form start -->
                    <form role="form" method="post" action="{{ URL_DASHBOARD2_PRODUCT_DO_SAVE }}">
                        <div class="box-body">
                            <div class="form-group">
                                <label>標題 / 產品名稱 (100)</label>
                                <input name="name" type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>副標題 (100)</label>
                                <input name="subtitle" type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>類別</label>
                                <select name="category_ids" class="form-control">
                                    @foreach($categoryPresenter->categoryOptions() as $key => $val)
                                        <option value="{{ $val->id }}">{{ $val->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>系列</label>
                                <select name="series_ids" class="form-control">
                                    @foreach($seriesPresenter->seriesOptions() as $key => $val)
                                        <option value="{{ $val->id }}">{{ $val->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <label>長 / length (cm)</label>
                                    </div>
                                    <div class="col-xs-4">
                                        <label>寬 / width (cm)</label>
                                    </div>
                                    <div class="col-xs-4">
                                        <label>高 / height (cm)</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <input name="length" type="text" class="form-control" pattern="^\d*\.?\d+$" required>
                                    </div>
                                    <div class="col-xs-4">
                                        <input name="width" type="text" class="form-control" pattern="^\d*\.?\d+$" required>
                                    </div>
                                    <div class="col-xs-4">
                                        <input name="height" type="text" class="form-control" pattern="^\d*\.?\d+$" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>顯示</label>
                                <select name="display" class="form-control">
                                    @foreach($commonPresenter->yesNoOptions() as $key => $val)
                                        <option value="{{ $key }}">{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>有效</label>
                                <select name="active" class="form-control">
                                    @foreach($commonPresenter->yesNoOptions() as $key => $val)
                                        <option value="{{ $key }}">{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>描述 (500)</label>
                                <textarea name="content" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                            </div>
                        </div>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-footer text-center">
                            <button type="submit" class="btn btn-info">Save</button>
                        </div>
                    </form>
                    <!-- end form -->
                </div>
            @endif
        </div>
    </div>

@endsection

@section('inner-js')
@endsection