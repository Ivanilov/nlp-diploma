<template>
    <fragment>
        <section class="hero is-success">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title">
                        Определение синонимов слова
                    </h1>
                    <h2 class="subtitle">
                        Нахождение списка синонимов для введеного слова
                    </h2>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container is-fluid">
                <div class="box" v-if="result">
                    <h1 class="title">Синонимы:</h1>
                    <ul>
                        <li v-for="item in result">
                            {{item}}
                        </li>
                    </ul>
                </div>
                <div class="box">
                    <b-field
                        label="Слово для определения синонимов"
                        :type="error ? 'is-danger' : ''"
                        :message="error ? errorMessage : ''"
                    >
                        <b-input
                            type="text"
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
                    <b-button type="is-success" :disabled="!text || !language" :loading="loading" @click="getNeighbouringResult">
                        Найти синонимы
                    </b-button>
                </div>
            </div>
        </section>
    </fragment>
</template>
<script>
    import { getNeighbouring } from "../../api";

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
            getNeighbouringResult() {
                let that = this;
                that.setLoading(true);
                getNeighbouring(
                    that.setDataToSend(),
                    (neighbours) => {
                        that.setLoading(false);
                        that.notify('Запрос успешно выполнен!', true);
                        that.setResult(neighbours.data.neighbours);
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
