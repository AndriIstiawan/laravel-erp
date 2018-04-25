<div class="modal" id="modal-exim" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" action="" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times; </span>
                </button>
                <h3 class="modal-title">Export/Import Product</h3>
            </div>

            <div class="modal-body">
                <div class="form-group">
                        <label for="file" class="col-md-3 control-label">Export</label>
                        <div class="col-md-6">
                            <a href="" class="btn btn-success">Export</a>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="file" class="col-md-3 control-label">Import</label>
                        <div class="col-md-6">
                            <input type="file" id="file" name="file" class="form-control" autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-save">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
