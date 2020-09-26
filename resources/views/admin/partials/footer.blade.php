<footer class="main-footer text-right">
    Copyright &copy; {{ date('Y') . ' ' . trans('admin.admin_title') }}.
    @lang('admin.footer.all-rights-reserved').
</footer>

<!-- Modal -->
<div class="modal fade" id="signout_modal" tabindex="-1" role="dialog" aria-labelledby="signoutModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="signoutModalLabel">
                    @lang('admin.admin_title')
                </h5>
            </div>
            <div class="modal-body">
                <h6>
                    @lang('admin.top-bar.modal.are-you-sure-logout')
                </h6>
            </div>
            <div class="modal-footer">
                {!! Form::open(['method' => 'POST', 'route' => ['auth.logout']]) !!}
                {!! Form::button(trans('admin.buttons.no'), ['class' => 'btn btn-default',  'data-dismiss' => 'modal']) !!}
                {!! Form::submit(trans('admin.buttons.yes'), ['class' => 'btn btn-success']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>