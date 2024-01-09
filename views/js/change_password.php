<script>
    const element = document.getElementById("change-password");
    async function changePassword() {
        try {
            await isElementExist(element);
            element.addEventListener('submit', (event) => {
                const data = processForm(event);
                const params = `user_id=${data.user_id}&current_password=${data.current_password}&new_password=${data.new_password}`;
                const url = '/thesis/user/edit/change-password';
                post(url, params);
                element.reset();
            });

        } catch (error) {
            console.log(error);
        }

    };
    changePassword();
</script>