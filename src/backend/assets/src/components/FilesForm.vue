<template>

    <b-card
        v-if="files"
        class="mb-4"
        :header="title"
        header-class="text-white bg-secondary"
        no-body
    >

        <b-card-body>

            <file-upload
                class="btn btn-primary mb-2"
                post-action="/files/api/v1/upload/image"
                extensions="gif,jpg,jpeg,png"
                accept="image/png,image/gif,image/jpeg"
                :multiple="multiple"
                :size="1024 * 1024 * 10"
                v-model="uploads"
                :headers="headers"
                @input-file="inputFile"
                ref="upload"
                :disabled="isLoading"
            >
                <span v-if="isLoading">
                    <i class="fa fa-spinner fa-spin"></i>
                    Загрузка ...
                </span>

                <span v-else>
                    <i class="fa fa-plus"></i>
                    Загрузить файлы
                </span>
            </file-upload>

            <div v-if="files.length" class="yc-files">

                <table class="table table-striped">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Изображение</th>
                            <th>Информация</th>
                            <th>Действия</th>
                        </tr>
                    </thead>

                    <draggable
                        v-model="files"
                        :element="'tbody'"
                        handle=".yc-file__handle"
                    >

                        <tr v-for="(file, index) in files"
                            v-if="file.status"
                            :key="file.id"
                            class="yc-file"
                        >

                            <td class="align-middle">
                                <i class="fa fa-arrows-alt yc-file__handle"></i>
                            </td>

                            <td class="align-middle">
                                <img class="yc-file__img" :src="src(file)" />
                            </td>

                            <td>

                                <b-form-group label="Имя" label-cols-sm="2">
                                    <div>{{ file.name }}</div>
                                </b-form-group>

                                <b-form-group label="Alt" label-cols-sm="2">
                                    <b-form-input
                                        type="text"
                                        v-model="file.alt"
                                        placeholder="Альтернативный тест"
                                        trim />
                                </b-form-group>

                                <b-form-group label="Title" label-cols-sm="2">
                                    <b-form-input
                                        type="text"
                                        v-model="file.title"
                                        placeholder="Заголовок"
                                        trim />
                                </b-form-group>
                            </td>

                            <td>
                                <b-button variant="danger" @click="file.status = false" title="Удалить">
                                    <i class="fa fa-trash"></i>
                                </b-button>
                            </td>
                        </tr>

                    </draggable>

                </table>

            </div>

        </b-card-body>

    </b-card>

</template>

<script>
    export default {

        props: {
            title: {
                type: String,
                default: 'Изображения'
            },
            models: {
                type: Array
            },
            multiple: Boolean,
        },

        data() {
            return {
                isLoading: false,
                uploads: [],
                headers: {
                    Authorization: 'Bearer '+ this.$auth.token()
                }
            }
        },

        computed: {
            files: {
                get () {
                    return this.models;
                },
                set (value) {
                    this.$emit('update:models', value);
                }
            },
            settings () {
                return this.$store.getters['commerce/settings'];
            }
        },

        watch: {
            models (models) {
                this.models = models;
            }
        },

        methods: {

            src (file) {
                if (file.modelId) {
                    return `/storage/${file.storageDirName}/${this.settings.files.presets.default.name}/${file.name}`;
                }

                return `/temp/${file.name}`;
            },

            inputFile (newFile, oldFile) {

                if (newFile && !oldFile) {
                    // Add file
                }

                if (newFile && oldFile) {
                    // Update file

                    // Start upload
                    if (newFile.active !== oldFile.active) {

                    }

                    // Upload error
                    if (newFile.error !== oldFile.error) {
                        this.isLoading = false;
                        this.$store.dispatch('failing', newFile.response);
                    }

                    // Uploaded successfully
                    if (newFile.success !== oldFile.success) {
                        this.isLoading = false;

                        if (!this.multiple) {
                            this.files.map(file => file.status = false);
                        }

                        this.files.push(newFile.response);
                    }
                }

                // Automatic upload
                if (Boolean(newFile) !== Boolean(oldFile) || oldFile.error !== newFile.error) {
                    if (!this.$refs.upload.active) {
                        this.isLoading = true;
                        this.$refs.upload.active = true
                    }
                }
            }

        }

    }
</script>
