<template>
    <fragment>
        <section class="hero is-primary">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title">
                        Определение языка
                    </h1>
                    <h2 class="subtitle">
                        Быстрое определение языка из введенного текста
                    </h2>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container is-fluid">
                <div class="box" v-if="result">
                    <h1 class="title">Ваш язык:</h1>
                    <h2 class="subtitle">
                        {{result}}
                    </h2>
                </div>
                <div class="box">
                    <b-field
                        label="Текст для определения языка"
                        :type="error ? 'is-danger' : ''"
                        :message="error ? errorMessage : ''"
                    >
                        <b-input
                            type="textarea"
                            required
                            validation-message="Это поле обязательно для заполнения"
                            placeholder="Введите ваш текст в данное поле"
                            v-model="text"
                            :loading="loading"
                            :disabled="loading"
                        ></b-input>
                    </b-field>
                    <b-button type="is-primary" :disabled="!text" :loading="loading" @click="getLang">
                        Узнать язык
                    </b-button>
                </div>
            </div>
        </section>
    </fragment>
</template>
<script>
    import {getLanguage} from "../../api";

    export default {
        data() {
            return {
                loading:false,
                text:'',
                result:'',
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
                    text: this.text
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
            getLang() {
                let that = this;
                that.setLoading(true);
                getLanguage(
                    that.setDataToSend(),
                    (language) => {
                        console.log(language);
                        that.setLoading(false);
                        that.notify('Запрос успешно выполнен!', true);
                        that.setResult(language.data.language);
                    },
                    (error) => {
                        console.log(error);
                        that.setLoading(false);
                        that.notify('Произошла ошибка!', false);
                        that.setResult('');
                        that.setError(true, error);
                    }
                )
            }
        }
    }
</script>
