$(() => {
    let baseUrl = "/api/v1"
    let headers = {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
    }
    let state = {};
    let loadDonations = (page = 1) => {
        $.ajax({
            url: `${baseUrl}/donations?page=${1}`,
            method: "get"
        }).done(resp => {
            state = resp
            state.data.forEach(donation => {
                let date = new Date(donation.created_at).toLocaleDateString("uk-UK")
                $("#tableBody").append(`<tr>
                    <td>${donation.name}</td>
                    <td>${donation.email}</td>
                    <td>${donation.amount}</td>
                    <td>${donation.message}</td>
                    <td>${date}</td>
                </tr>`)
            })
        })
    }
    loadDonations();
    let donationForm = $("#donationForm")

    donationForm.on("submit", event => {
        event.preventDefault()
        event.stopPropagation()
        donationForm.addClass("was-validated")
        $.ajax({
            url: `${baseUrl}/donations`,
            headers: headers,
            method: "post",
            dataType: "json",
            data: {
                name: $("#inputName").val(),
                email: $("#inputEmail").val(),
                amount: $("#inputAmount").val(),
                message: $("#inputMessage").val(),
            }
        }).done(() => {
            $("#donationModal").modal("hide");
        })
    })
})
