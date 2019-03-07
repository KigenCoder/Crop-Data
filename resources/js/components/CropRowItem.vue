<template>

    <tr>
        <td>{{item.Zone}}</td>
        <td>{{item.region}}</td>
        <td>{{item.district}}</td>
        <td>{{item.year}}</td>
        <td>{{item.crop}}</td>
        <td>{{item.livelihood_system}}</td>
        <td>{{item.season}}</td>
        <td>{{item.production_period}}</td>
        <td>{{item.production}}</td>
    </tr>
</template>


<script>
    export default {
        props: ["item"],
    }
</script>