<template>
    <b-navbar type="is-dark" :fixed-top="true">
        <template slot="brand">
            <b-navbar-item tag="router-link" :to="{name: 'home'}">
                <h1> NLP DIPLOMA</h1>
            </b-navbar-item>
        </template>
        <template slot="end">
            <b-navbar-item tag="router-link" :to="{name: 'home'}">
                Домой
            </b-navbar-item>
            <b-navbar-item tag="router-link" :to="{name: 'lang.detect'}">
                Определение языка
            </b-navbar-item>
            <b-navbar-item tag="router-link" :to="{name: 'sentiment'}">
                Тональность
            </b-navbar-item>
            <b-navbar-item tag="router-link" :to="{name: 'neighbouring'}">
                Синонимы
            </b-navbar-item>
            <b-navbar-item tag="router-link" :to="{name: 'concept'}">
                Граф значений
            </b-navbar-item>
            <b-navbar-item tag="router-link" :to="{name: 'summarize'}">
                Определение заключения
            </b-navbar-item>
        </template>
    </b-navbar>
</template>
