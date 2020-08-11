<template>
    <fragment>
        <section class="hero is-info">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title">
                        Определение "сути" текста
                    </h1>
                    <h2 class="subtitle">
                        Выделение из большого количества текста - одного предложения, которое описывает всю суть, т.е. дает "заключение"
                    </h2>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container is-fluid">
                <div class="box" v-if="result">
                    <h1 class="title">Заключение:</h1>
                    <h2 class="subtitle">
                        {{result }}
                    </h2>
                </div>
                <div class="box">
                    <b-field
                        label="Текст"
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
                    <b-button type="is-info" :disabled="!text" :loading="loading" @click="getSummarize">
                        Узнать заключение
                    </b-button>
                </div>
            </div>
        </section>
    </fragment>
</template>
<script>
    import { getSummerization } from "../../api";

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
            getSummarize() {
                let that = this;
                that.setLoading(true);
                getSummerization(
                    that.setDataToSend(),
                    (summerize) => {
                        that.setLoading(false);
                        that.notify('Запрос успешно выполнен!', true);
                        that.setResult(summerize.data.summarize);
                    },
                    (error) => {
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
