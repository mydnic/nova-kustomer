<template>
    <div>
        <feedback-detail-card :feedback-id="feedbackId"></feedback-detail-card>
    </div>
</template>

<script>

export default {
    props: ['feedbackId'],
    components: {
        'feedback-detail-card': require('./../components/FeedbackDetail.vue').default,
    }
}
</script>
