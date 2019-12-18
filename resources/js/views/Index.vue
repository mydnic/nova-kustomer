<template>
    <div>
        <heading class="mb-6">Kustomer Feedbacks</heading>

        <feedbacks-table></feedbacks-table>
    </div>
</template>

<script>
export default {
    components: {
        'feedbacks-table': require('./../components/FeedbacksTable.vue').default
    }
}
</script>

<style>
    /* Scoped Styles */
</style>
