<template>
    <div>
        <div class="flex mb-6 items-center justify-between">
            <heading>Feedback Details</heading>

            <button
                @click="markAsReviewed"
                class="btn btn-default flex items-center"
                :class="{
                    'cursor-default text-grey btn-white': feedback.reviewed,
                    'btn-primary': !feedback.reviewed
                }"
                :disabled="feedback.reviewed"
            >
                <review-icon></review-icon>
                <span class="inline-block ml-2" v-if="!feedback.reviewed">Mark As Reviewed</span>
                <span class="inline-block ml-2" v-if="feedback.reviewed">Already Reviewed</span>
            </button>
        </div>
        <loading-card :loading="initialLoading" class="mb-6 py-3 px-6">
            <detail-text-field :field="{name: 'ID', value: feedback.id}"></detail-text-field>
            <detail-text-field :field="{name: 'Message', value: feedback.message}"></detail-text-field>
            <detail-boolean-field :field="{name: 'Is Reviewed', value: feedback.reviewed}"></detail-boolean-field>
        </loading-card>
        <heading class="mb-6">User Request</heading>
        <card class="card relative mb-6 py-3 px-6" v-if="!initialLoading">
            <detail-text-field :field="{name: 'Created At', value: feedback.created_at}"></detail-text-field>
            <detail-text-field :field="{name: 'Url', value: feedback.user_info.url}"></detail-text-field>
            <detail-text-field :field="{name: 'User Agent', value: feedback.user_info.agent}"></detail-text-field>
            <detail-text-field :field="{name: 'Language', value: feedback.user_info.language}"></detail-text-field>
            <detail-text-field :field="{name: 'User ID', value: feedback.user_info.user_id}"></detail-text-field>
            <detail-text-field v-if="feedback.viewport" :field="{name: 'Viewport size', value: viewport}"></detail-text-field>
            <detail-file-field v-if="feedback.screenshot" :field="{
                name: 'Screenshot',
                value: feedback.screenshot,
                thumbnailUrl: feedback.screenshot,
                attribute: 'screenshot'
            }"></detail-file-field>
            <detail-text-field v-if="feedback.screenshot" :field="{
                name: 'Open Screenshot',
                value: htmlLink,
                asHtml: true,
            }"></detail-text-field>
        </card>
    </div>
</template>

<script>
export default {
    props: ['feedbackId'],

    data() {
        return {
            initialLoading: true,
            feedback: {}
        }
    },

    methods: {
        getFeedback() {
            Nova.request().get('/nova-vendor/nova-kustomer/feedback/' + this.feedbackId)
                .then((response) => {
                    this.feedback = response.data
                    this.initialLoading = false
                })
        },
        markAsReviewed() {
            Nova.request().post('/nova-vendor/nova-kustomer/feedback/' + this.feedbackId + '/review')
                .then((response) => {
                    this.feedback.reviewed = true
                })
        }
    },

    created() {
        this.getFeedback()
    },

    computed: {
        viewport() {
            return this.feedback.user_info.viewport.width
            + 'x'
            + this.feedback.user_info.viewport.height
        },
        htmlLink() {
            return '<a target="_blank" href="' + this.feedback.screenshot + '">Link</a>';
        }
    },

    components: {
        'review-icon': require('./Icons/ReviewIcon.vue')
    }
}
</script>
