$(() => {
    let baseUrl = "/api/v1"

    let rows = [];
    let donationForm = $("#donationForm")

    donationForm.on("submit", event => {
        event.preventDefault()
        event.stopPropagation()
        donationForm.addClass("was-validated")
        $.ajax({
            url: `${baseUrl}/donations`,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            },
            method: "post",
            dataType: "json",
            data: {
                name: $("#inputName").val(),
                email: $("#inputEmail").val(),
                amount: $("#inputAmount").val(),
                message: $("#inputMessage").val(),
            }
        }).done( data => {
            $("#donationModal").modal("hide");
        })
    })
})
