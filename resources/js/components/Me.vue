<script setup>

    const callMe = () => {
        const url = 'http://localhost:8000/me';

        fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(response => response.json())
        .then(data => {
            console.log(data)
        })

    }

</script>

<template>
    <button @click="callMe">Call Me</button>
</template>