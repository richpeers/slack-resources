<template>
    <div class="container">
        <div class="alert alert-info">
            <p>Example implementation of my <a href="https://github.com/richpeers/laravel-slack-resources" target="_blank">Slack Resources Package</a> for <a href="https://larahack.com" target="_blank">LaraHack #4</a>.
                With this package configured for your slack workspace, you can then type <strong><i>/resource url tag</i></strong> to save the resource and tag it. The system will queue a job to fetch meta data for the resource.</p>
        </div>
        <div class="row">
            <tags :tags="tags" :tag="tag" @set-tag="setTag"></tags>

            <resources :resources="resources"></resources>
        </div>
    </div>
</template>

<script>
    import Tags from "./Tags";
    import Resources from "./Resources";

    export default {
        name: "SlackResourceIndex",
        components: {Resources, Tags},
        props: {
            tags: Array
        },
        data: () => ({
            tag: '',
            page: 1,
            resources: []
        }),
        computed: {
            params() {
                let paramsArray = [];

                if (this.tag !== '') {
                    paramsArray.push('tag=' + this.tag);
                }

                if (this.page > 1) {
                    paramsArray.push('page=' + this.page);
                }

                let params = '';

                if (paramsArray.length > 0) {
                    params += '?' + paramsArray.join('&');

                }

                return params;
            }
        },
        methods: {
            fetch() {
                window.axios.get('/resources' + this.params)
                    .then(response => {
                        this.resources = response.data.data
                    });
            },
            setTag(id) {
                this.tag = id;
                this.fetch();
            }
        },
        mounted() {
            this.fetch();
        }
    }
</script>
