@extends('advantageacl::layouts.admin-app')
@section('content')
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="card">
                        <div class="card-header">
                      <i class="fa fa-align-justify"></i> {{ __('acl-modules.edit_module') }} </div>
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


                                <br>
                            <form action="{{route('admin.aclmodules.update')}}" method="POST">
                                 @csrf
                                <input name="_method" type="hidden" value="PUT">
                                <input type="hidden" value="{{$aclModule['id']}}" name="id">
                                <div class="form-group row">
                                     <label for="moduleName" class="col-sm-2 col-form-label">{{ __('acl-modules.module_name') }}</label>
                                    <div class="col-sm-10">
                                      <input type="text" placeholder="{{ __('acl-modules.module_name') }}" id="moduleName" name="module_name" value="{{ $aclModule['module_name'] }}" class="form-control{{ $errors->has('module_name') ? ' is-invalid' : '' }}" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="modulePath" class="col-sm-2 col-form-label">{{ __('acl-modules.module_path') }}</label>
                                    <div class="col-sm-10">
                                    <input id="modulePath" name="module_path"  class="form-control{{ $errors->has('module_path') ? ' is-invalid' : '' }}" type="text" placeholder="{{ __('acl-modules.module_path') }}" value="{{ $aclModule['module_path']}}">
                                    </div>
                                </div>
                            <div class="form-group row">
                                <label for="moduleDescription" class="col-sm-2 col-form-label">{{ __('acl-modules.module_description') }}</label>
                                <div class="col-sm-10">
                                 <textarea id="moduleDescription" name="module_description" class="form-control{{ $errors->has('module_description') ? ' is-invalid' : '' }}"  type="text" placeholder="{{ __('acl-modules.module_description') }}">{{$aclModule['module_description']}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                            <label for="aclMenusId" class="col-sm-2 col-form-label">{{ __('acl-modules.select_menu') }}</label>
                                <div class="col-sm-10">
                                <select id="aclMenusId"  name="acl_menus_id" class="form-control{{ $errors->has('acl_menus_id') ? ' is-invalid' : '' }}" id="menu" aria-describedby="nameHelp">
                                    <option value="">{{ __('acl-modules.select_menu') }}</option>
                                    @foreach($aclMenus as $id => $menu)
                                        @if($aclModule['acl_menus_id'] == $id)
                                            @php
                                                $selected = "selected";
                                            @endphp
                                        @else
                                            @php
                                                $selected = "";
                                            @endphp
                                        @endif
                                        <option value="{{$id}}" {{$selected}}>{{$menu}}</option>
                                    @endforeach
                                </select>

                            </div>
                            </div>
                            <div class="form-group row">
                             <div class="col-sm-10">
                               <label for="status" class="col-sm-2 col-form-label">{{ __('acl-modules.status') }}</label>
                               <input type="checkbox" @if($aclModule['status']=='Active') checked="checked" @endif name="status">
                            </div>
                            </div>

                            <div class="form-group row">
                             <div class="col-sm-10">
                              <button class="btn btn-success mb-2" type="submit">{{ __('Save') }}</button>
                              <a href="{{ route('admin.aclmodules') }}" class="btn btn-secondary mb-2">{{ __('Return') }}</a>
                            </div>
                           </div>

                        </form>
                        <div class="card-footer">
                        @if(count($aclModuleRoutes))
                           <div class="container pb-2">
                                <h5>Available Routes</h5>
                                <ol>
                                    @foreach($aclModuleRoutes as $module)
                                        <li>{{$module['route']}}</li>
                                    @endforeach
                                </ol>
                            </div>
                        @endif
                       </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection

@section('javascript')

@endsection