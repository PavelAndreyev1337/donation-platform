<div id="donationModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add donation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body justify-content-center">
                <form id="donationForm" class="needs-validation" novalidate>
                    <div class="form-group">
                        <label for="inputName">Donator Name</label>
                        <input type="text" class="form-control" id="inputName" name="name" required>
                        <div class="invalid-feedback">
                            Please provide a valid name.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" name="email" required>
                        <div class="invalid-feedback">
                            Please provide a valid email.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAmount">Amout</label>
                        <input type="number" min="0.01" step="0.01" id="inputAmount" name="amount" class="form-control" id="inputAmout" required>
                        <div class="invalid-feedback">
                            Please provide a valid amount.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMessage">Message</label>
                        <textarea class="form-control" id="inputMessage" name="message" rows="3"></textarea>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button id="submitBtn" type="submit" class="btn btn-primary btn-block">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>