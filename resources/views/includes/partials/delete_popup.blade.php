<!-- Modal -->
<div class="modal fade" id="delete_data_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ __('Delete Record')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    @if(isset($message) && !empty($message))
                        {{ $message }}
                    @else
                        {{ __('acl-modules.delete_module_confirm')}}
                    @endif
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {{ __('acl-modules.close')}}
                </button>
                <a href="javascript:void(0)" type="button" id="delete_action" class="btn btn-danger">
                    {{ __('acl-modules.delete')}}
                </a>
            </div>
        </div>
    </div>
</div>

@section('javascript')
    <script>
        function deletePopup(url) {
            $('#delete_action').on('click',  function (e) {
                location.href = url;
            });
        }
    </script>
@endsection