<script>
    function isElementExist(element) {
        if (!element) {
            throw new Error("Element do not exist");
        }
    }

    function processForm(event) {
        event.preventDefault();

        const formData = new FormData(event.target);
        const data = {};

        formData.forEach(function(value, key) {
            data[key] = value;
        });

        return data;
    }

    function post(url, params) {
        xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                const data = JSON.parse(xhr.responseText);
                const toast = new bootstrap.Toast(document.getElementById("response"));
                document.getElementById("toast-body").innerHTML = data.response;
                toast.show();
            }
        };
        xhr.send(
            params
        );
    }
    function alumniPost(url, params) {
        xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                const data = JSON.parse(xhr.responseText);
                if (data.response === "success"){
                    window.location.replace("/thesis/login");
                }
                const toast = new bootstrap.Toast(document.getElementById("response"));
                document.getElementById("toast-body").innerHTML = data.response;
                toast.show();
            }
        };
        xhr.send(
            params
        );
    }

    function postContent(url, params){
        
    }
</script>