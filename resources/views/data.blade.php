@extends('layout')

@section('activeTbl')
    active
@endsection

@section('pageTitle')
    Add Transection
@endsection

@section('content')
    <div class="col-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">New Transection</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="/data/submit" method="POST">
                @csrf
                @method('POST')
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="atpTitle"
                            placeholder="Enter transection title">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Descreption</label>
                        <textarea name="atpDesc" class="form-control" rows="4" placeholder="Enter Project Descreption"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" step="0.01" class="form-control" id="amount" name="atpAmount"
                            placeholder="Enter transection amount">
                    </div>
                    <div class="form-group">
                        <label for="type">Transection Type</label><br>
                        <table>
                            <tr>
                                <td>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" name="atpPlatform" value="1" id="checkboxPrimary1">
                                        <label for="checkboxPrimary1">Freelancers</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" name="atpPlatform" value="2" id="checkboxPrimary2">
                                        <label for="checkboxPrimary2">Upwork</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" name="atpPlatform" value="3" id="checkboxPrimary3">
                                        <label for="checkboxPrimary3">Linkedin</label>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Add Project</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
@endsection
