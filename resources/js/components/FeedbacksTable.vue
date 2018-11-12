<template>
    <loading-view :loading="initialLoading">
        <loading-card :loading="loading" class="card relative">
            <table
                class="table w-full"
                cellpadding="0"
                cellspacing="0"
            >
                <thead>
                    <tr>
                        <th class="text-left">
                            ID
                        </th>
                        <th class="text-left">
                            Type
                        </th>
                        <th class="text-left">
                            Message
                        </th>
                        <th>
                            Reviewed
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="feedbacks.length === 0">
                        <td class="text-center" colspan="4">
                            {{ __('No Feedbacks') }}
                        </td>
                    </tr>
                    <tr v-for="feedback in feedbacks" :key="feedback.id">
                        <td>{{ feedback.id }}</td>
                        <td>
                            <div class="flex items-center">
                                <img :src="feedback.icon" :alt="feedback.type" class="w-4 h-4 mr-2">
                                {{ feedback.type }}
                            </div>
                        </td>
                        <td>{{ feedback.message }}</td>
                        <td>
                            <index-boolean-field :field="{name: 'Is Reviewed', value: feedback.reviewed}"></index-boolean-field>
                        </td>
                        <td class="td-fit text-right pr-6">
                            <div class="flex items-center">
                                <router-link
                                    class="cursor-pointer text-70 hover:text-primary mr-3"
                                    :to="{ name: 'feedback-detail', params: {
                                        feedbackId: feedback.id
                                    }}"
                                    :title="__('View')"
                                >
                                    <icon type="view" width="22" height="18" view-box="0 0 22 16" />
                                </router-link>

                                <button
                                    title="MarkAsReviewed"
                                    class="appearance-none cursor-pointer text-70 hover:text-primary mr-3"
                                    @click="markAsReviewed(feedback)"
                                    :disabled="feedback.reviewed"
                                >
                                    <review-icon></review-icon>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </loading-card>
    </loading-view>
</template>

<script>
export default {
    data() {
        return {
            feedbacks: [],
            initialLoading: true,
            loading: false,
        }
    },

    mounted() {
        this.getFeedbacks();
    },

    methods: {
        getFeedbacks() {
            Nova.request().get('/nova-vendor/nova-kustomer/feedbacks').then(response => {
                this.feedbacks = response.data;
                this.initialLoading = false
                this.loading = false
            });
        },

        markAsReviewed(feedback) {
            Nova.request().post('/nova-vendor/nova-kustomer/feedback/' + feedback.id + '/review')
                .then((response) => {
                    feedback.reviewed = true
                })
        }
    },

    components: {
        'review-icon': require('./Icons/ReviewIcon.vue')
    }
}
</script>

<style>
/* Scoped Styles */
</style>
