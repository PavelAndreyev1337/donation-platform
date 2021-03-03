$(() => {
    let baseUrl = "/api/v1"
    let headers = {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
    }
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
    let showStatistic = (topDonator, dayAmount, monthAmount) => {
        $("#topDonator > #number").text(topDonator.amount)
        $("#topDonator > #name").text(topDonator.name)
        $("#dayAmount > #number").text(dayAmount)
        $("#monthAmount > #number").text(monthAmount)
    }
    let showChart = resp => {
        let drawChart = () => {
            let values = [['Date', 'Amount',]].concat(Object.entries(resp))
            let data = google.visualization.arrayToDataTable(values);
            let options = {
                title: 'Donations Statistics',
                legend: { position: 'bottom' }
            };
            let chart = new google.visualization.LineChart($("#chart").get(0));
            chart.draw(data, options);
        }
        google.charts.load('current', { 'packages': ['corechart'] });
        google.charts.setOnLoadCallback(drawChart);
    }
    let tableBody = $("#tableBody")
    let clearDonations = () => {
        tableBody.empty()
    }
    let showDonationsLoader = () => {
        clearDonations()
        tableBody.append(`<tr><td class="text-center" colspan="5">
        <div class="spinner-border text-primary">
            <span class="sr-only">Loading...</span>
        </div></td></tr>`)
    }
    let showDonations = (data) => {
        clearDonations()
        data.forEach(donation => {
            let date = new Date(donation.created_at).toLocaleDateString("uk-UK")
            tableBody.append(`<tr>
            <td>${donation.name}</td>
            <td>${donation.email}</td>
            <td>${donation.amount}</td>
            <td>${donation.message}</td>
            <td>${date}</td>
            </tr>`)
        })
    }
    let showPagination = links => {
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
            sendRequest($(event.target).attr("href"))
            paginator.empty()
        })
    }
    let storage = {}
    let sendRequest = url => {
        showDonationsLoader()
        $.ajax({
            url: url,
            method: "get"
        }).done(resp => {
            storage = resp
            showStatistic(resp.topDonator, resp.dayAmount, resp.monthAmount)
            showChart(resp.chart)
            showDonations(resp.data)
            showPagination(resp.meta.links)
        })
    }
    sendRequest(`${baseUrl}/donations?page=1`)
    Pusher.logToConsole = true
    let pusher = new Pusher('539fdecc3410ebdc8726', {
        cluster: 'eu'
    })
    let channel = pusher.subscribe('donations-channel');
    channel.bind('donation-added', data => {
    })
})
