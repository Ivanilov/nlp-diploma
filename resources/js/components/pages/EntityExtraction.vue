<template>
    <fragment>
        <section class="hero is-danger">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title">
                        Нахождение сущностей текста
                    </h1>
                    <h2 class="subtitle">
                        Нахождение списка сущностей в 3 категориях (локация, организация, личность) из текста
                    </h2>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container is-fluid">
                <div class="box" v-if="result">
                    <h1 class="title">Сущности:</h1>
                    <div class="columns">
                        <div class="column">
                            <h2>
                                Локации:
                            </h2>
                            <ul>
                                <li v-for="item in result['Locations']">
                                    {{item}}
                                </li>
                            </ul>
                        </div>
                        <div class="column">
                            <h2>
                                Организации:
                            </h2>
                            <ul>
                                <li v-for="item in result['Organizations']">
                                    {{item}}
                                </li>
                            </ul>
                        </div>
                        <div class="column">
                            <h2>
                                Личности:
                            </h2>
                            <ul>
                                <li v-for="item in result['Persons']">
                                    {{item}}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <ul>

                    </ul>
                </div>
                <div class="box">
                    <b-field
                        label="Текст для поиска сущностей"
                        :type="error ? 'is-danger' : ''"
                        :message="error ? errorMessage : ''"
                    >
                        <b-input
                            type="textarea"
                            required
                            validation-message="Это поле обязательно для заполнения"
                            placeholder="Введите ваше слово в данное поле"
                            v-model="text"
                            :loading="loading"
                            :disabled="loading"
                        ></b-input>
                    </b-field>
                    <div class="block">
                        <b-radio v-model="language"
                                 name="name"
                                 size="is-medium"
                                 type="is-success"
                                 native-value="en">
                            English
                        </b-radio>
                        <b-radio v-model="language"
                                 name="name"
                                 size="is-medium"
                                 type="is-success"
                                 native-value="ru">
                            Русский
                        </b-radio>
                        <b-radio v-model="language"
                                 name="name"
                                 size="is-medium"
                                 type="is-success"
                                 native-value="uk">
                            Українська
                        </b-radio>
                    </div>
                    <b-button type="is-danger" :disabled="!text || !language" :loading="loading" @click="getEntityExtractResult">
                        Найти сущности
                    </b-button>
                </div>
            </div>
        </section>
    </fragment>
</template>
<script>
    import { getEntitiesExtract } from "../../api";

    export default {
        data() {
            return {
                loading:false,
                text:'',
                language:'',
                result:null,
                error:false,
                errorMessage:''
            }
        },
        methods: {
            setLoading(state) {
                this.loading = state;
            },
            setError(state, message) {
                this.error = state;
                this.errorMessage = message;
            },
            setDataToSend() {
                return {
                    text: this.text,
                    language: this.language
                }
            },
            setResult(data) {
                this.result = data;
            },
            notify(message, isSuccess) {
                this.$buefy.notification.open({
                    duration:5000,
                    message:message,
                    position:'is-top-right',
                    type:isSuccess ? 'is-success' : 'is-danger',
                    hasIcon:true
                });
            },
            getEntityExtractResult() {
                let that = this;
                that.setLoading(true);
                getEntitiesExtract(
                    that.setDataToSend(),
                    (entities) => {
                        that.setLoading(false);
                        that.notify('Запрос успешно выполнен!', true);
                        that.setResult(entities.data.entities);
                    },
                    (error) => {
                        that.setLoading(false);
                        that.notify('Произошла ошибка!', false);
                        that.setResult('');
                        that.setError(true, error);
                    }
                )
            },
        }
    }
</script>
