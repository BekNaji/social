<!-- The Modal -->
<div class="modal fade" id="removeCommentModal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Remove Comment</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <p>You remove Comment ?</p>
                <form id="commentRemoveForm">
                    @csrf
                    <input type="hidden" name="id" id="commentRemoveId">
                    <input type="hidden" name="post_id" id="commentPostId">
                    <button class="btn btn-outline-primary">Yes</button>
                     <button type="submit" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                </form>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
               
            </div>
            
        </div>
    </div>
</div>