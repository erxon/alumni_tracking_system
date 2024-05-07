<script>
    const contentsToHighlight = {
        event: $("#current-event-highlight").val(),
        news: $("#current-news-highlight").val()
    }

    $("#event-selection").on("change", (event) => {
        $("#event-preview-container").empty();
        console.log(event.target.value);
        const eventId = event.target.value;

        $.ajax({
            type: "GET",
            url: `/thesis/admin/home/layout/server?id=${eventId}`,
            success: (response) => {
                const parsedResponse = JSON.parse(response);
                const event = parsedResponse.result
                const eventStart = new Date(event.eventStart);
                const eventEnd = new Date(event.eventEnd);

                $("#event-preview-container").fadeIn();
                $("#event-preview-container").append(
                    `
                    <img style="width: 100%; height: 200px;" src="/thesis/public/images/cover/${event.coverImage}" />
                    <p class="fw-semibold mt-1">${event.title}</p>
                    <p class="mt-1">${event.description.substring(0, 50)}...</p>
                    <div style="font-size: 14px;">
                        <p class="m-0"><span class="fw-semibold">Event start: </span> ${eventStart.toDateString()} at ${eventStart.toLocaleTimeString()}</p>
                        <p class="m-0"><span class="fw-semibold">Event end: </span>${eventEnd.toDateString()} at ${eventEnd.toLocaleTimeString()}</p>
                    </div>
                    `
                );
            }

        });

        contentsToHighlight.event = eventId;
    });

    $("#news-selection").on("change", (event) => {
        $("#news-preview-container").empty();
        console.log(event.target.value);
        const newsId = event.target.value;

        $.ajax({
            type: "GET",
            url: `/thesis/admin/home/layout/server?id=${newsId}`,
            success: (response) => {
                const parsedResponse = JSON.parse(response);
                const news = parsedResponse.result;
                const newsDateCreated = new Date(news.dateCreated);

                $("#news-preview-container").fadeIn();
                $("#news-preview-container").append(
                    `
                    <img style="width: 100%; height: 200px; object-fit: cover" src="/thesis/public/images/cover/${news.coverImage}" />
                    <p class="fw-semibold m-0 mt-1">${news.title}</p>
                    <p class="m-0">${news.description.substring(0, 50)}...</p>
                    <p style="font-size: 14px;" class="m-0 mt-3">${newsDateCreated.toDateString()}</p>
                    `
                );
            }
        });

        contentsToHighlight.news = newsId;
    });

    $("#save-home-page-layout").on("click", () => {
        console.log(contentsToHighlight);
        const toast = new bootstrap.Toast("#response");

        const data = new FormData();

        data.append("eventHighlight", contentsToHighlight.event);
        data.append("newsHighlight", contentsToHighlight.news);

        $.ajax({
            type: "POST",
            url: `/thesis/admin/home/layout/server`,
            data: data,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                console.log(response);

                $(".toast-body").empty();
                if (response.response) {

                    toast.show();
                    $(".toast-body").append(`New home page layout successfully saved`);
                    $("#response").addClass("text-bg-success");
                } else {
                    toast.show();
                    const toast = new bootstrap.Toast("#error-response");

                    $(".toast-body").append(`Something went wrong`);
                    
                }
            }
        });
    })
</script>