<!-- The Modal -->
<div class="modal fade" id="editCommentModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Comment</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <p>Comment Content</p>
                <form id="commentEditForm">
                    @csrf
                    <input type="hidden" name="id" id="commentEditId">
                    <input type="hidden" name="post_id" id="commentPostId">
                    <textarea rows="10" id="commentEditContent" name="comment_edit_content" class="form-control " required></textarea>
                    @error('comment_edit_content')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <br>
                    <button class="btn btn-outline-primary updateComment">Update</button>
                     <button type="submit" class="btn btn-outline-secondary " data-dismiss="modal">Cancel</button>
                </form>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
               
            </div>
            
        </div>
    </div>
</div>