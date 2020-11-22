<!-- The Modal -->
<div class="modal fade" id="removePostModal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Remove Post</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <p>You remove POST ?</p>
                <form action="{{ route('post.remove') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="removeId">
                    <button class="btn btn-outline-primary">Yes</button>
                     <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                </form>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
               
            </div>
            
        </div>
    </div>
</div>