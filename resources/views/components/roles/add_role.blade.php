@extends('advantageacl::layouts.admin-app')
@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> {{ __('acl-roles.add_role') }} </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="flash-message">
                                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                    @if(Session::has('alert-'.$msg))
                                        <p class="alert alert-{{ $msg }}">{{ Session('alert-'.$msg) }}</p>
                                    @endif
                                @endforeach
                            </div>
                            <form method="POST" action="{{ url('/admin/roles/store')}}">
                                @csrf
                                <div class="form-group row">
                                    <label for="roleName" class="col-sm-2 col-form-label">{{ __('acl-roles.role_name') }}*</label>
                                    <div class="col-sm-10">
                                        <input type="text" placeholder="{{ __('acl-roles.role_name') }}" id="roleName" name="role_name" value="{{old('role_name')}}" class="form-control{{ $errors->has('role_name') ? ' is-invalid' : '' }}" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="roleDescription" class="col-sm-2 col-form-label">{{ __('acl-roles.role_description') }}</label>
                                    <div class="col-sm-10">
                                        <textarea id="roleDescription" name="role_description" class="form-control{{ $errors->has('role_description') ? ' is-invalid' : '' }}"  type="text" placeholder="{{ __('acl-roles.role_description') }}">{{old('role_description')}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <label for="status" class="col-sm-2 col-form-label">{{ __('acl-modules.status') }}</label>
                                        <input type="checkbox" @if(old('status')=='Active') checked="checked" @endif name="status">
                                    </div>
                                </div>
                                <div class="container">
                                    <h5><span class="m-section__sub">Permissions</span></h5>
                                    <div class="form-group row">
                                        @foreach($aclModules as $module)
                                            <div class="col-sm-10">
                                                <label for="">
                                                    <b>{{$module['module_name']}}</b>
                                                </label>
                                                <div class="m-checkbox-inline">
                                                    @foreach($module->modules_route as $moduleRoute)
                                                        <input type="checkbox" name="permission[]" value="{{$moduleRoute['id']}}">
                                                        <label class="">{{$moduleRoute['route']}}</label> <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button class="btn btn-success mb-2" type="submit">{{ __('Save') }}</button>
                                        <a href="{{ route('admin.aclrole.list') }}" class="btn btn-secondary mb-2">{{ __('Return') }}</a>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')

@endsection