<div>
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="5000">
                <img style="height: 500px; object-fit: cover" src="/thesis/public/images/cover/<?php echo $newsHighlight["coverImage"] ?>" class="d-block w-100">
                <div class="py-5 carousel-caption bg-dark rounded d-none d-md-block">
                    <h2><?php echo $newsHighlight["title"] ?></h2>
                    <p class="fw-light"><?php echo $stringUtil->truncate($newsHighlight["description"], 70) ?></p>
                    <a role="button" href="/thesis/contents/news?id=<?php echo $newsHighlight["newsHighlight"]; ?>" class="btn btn-sm btn-light">Read<i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="5000">
                <img style="height: 500px; object-fit: cover" src="/thesis/public/images/cover/<?php echo $eventHighlight["coverImage"] ?>" class="d-block w-100">
                <div class="py-5 carousel-caption bg-dark rounded d-none d-md-block">
                    <h2><?php echo $eventHighlight["title"] ?></h2>
                    <p><?php echo $stringUtil->truncate($eventHighlight["description"], 70) ?></p>
                    <a role="button" href="/thesis/contents/events?id=<?php echo $eventHighlight["eventHighlight"]; ?>" class="btn btn-sm btn-light">Read<i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>