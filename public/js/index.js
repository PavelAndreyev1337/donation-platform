$(() => {
    let baseUrl = "/api/v1"
    let headers = {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
    }
    let showPagination = (links) => {
        let paginator = $("#donationsPaginator")
        links.forEach(link => {
            let classes = link.active ? "active" : ""
            classes += link.url ? "" : "disabled"
            paginator.append(`<ul class="pagination">
            <li class="page-item ${classes}">
                <a class="page-link" 
                href="${link.url}" data-page="${link.label}">${link.label}</a>
            </li></ul>`)
        })
        $("a.page-link").on("click", event => {
            event.preventDefault()
            showDonations($(event.target).attr("href"))
            paginator.empty()
        })
    }
    let showDonations = url => {
        let tableBody = $("#tableBody")
        tableBody.empty()
        tableBody.append(`<tr><td class="text-center" colspan="5">
        <div class="spinner-border text-primary">
            <span class="sr-only">Loading...</span>
        </div></td></tr>`)
        $.ajax({
            url: url,
            method: "get"
        }).done(resp => {
            tableBody.empty()
            resp.data.forEach(donation => {
                let date = new Date(donation.created_at).toLocaleDateString("uk-UK")
                tableBody.append(`<tr>
                <td>${donation.name}</td>
                <td>${donation.email}</td>
                <td>${donation.amount}</td>
                <td>${donation.message}</td>
                <td>${date}</td>
                </tr>`)
            })
            showPagination(resp.meta.links)
        })
    }
    showDonations(`${baseUrl}/donations?page=1`);
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
