<template>
  <field @submit="submit" :field.sync="field" />
</template>

<script>
import Field from './Field'
export default {
  components: { Field },
  data() {
    return {
      field: {}
    }
  },
  async created() {
    let response = await this.axios.get(`edu/admin/lesson/${this.$route.params.id}/edit`)
    response.data.tags = response.data.tags.map(t => t.id)
    this.$set(this, 'field', response.data)
  },
  methods: {
    async submit(lesson) {
      await this.axios.put(`edu/admin/lesson/${this.field.id}`, this.field)
      this.$router.push({ name: 'admin.lesson' })
    }
  }
}
</script>

<style></style>
