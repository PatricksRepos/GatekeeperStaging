<script setup>
const props = defineProps({
  event: Object
});

const bg_image = 'url(' + props.event.bg_image_url + ')';
</script>
<style>
.v-card-title#event-header {
  color: white;
  background: linear-gradient(to right, rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.3)),
  v-bind('bg_image'),
  linear-gradient(rgba(114, 76, 195, 1.0),
    rgba(114, 76, 195, 1.0)) center center;
  background-size: cover;

}
</style>
<template>
  <v-card>
    <v-card-title class="d-flex justify-center py-8" id="event-header" dusk="event-header">
      <v-avatar :image="event.profile_photo_url" class="me-4" size="96" dusk="event-profile-avatar"/>
      <div class="text-start">
        <p dusk="event-team-name">
          <v-avatar :image="event.team.profile_photo_url" size="24" class="me-2" dusk="event-team-avatar"/>
          {{ event.team.name }} presents
        </p>
        <h2 dusk="event-name">{{ event.name }}</h2>
      </div>
    </v-card-title>

    <hr />

    <v-card-text v-if="event.description" dusk="event-description">
      {{ event.description }}
    </v-card-text>

    <v-card-text class="font-weight-bold" dusk="event-location">
      <p v-if="event.location">
        <v-icon icon="mdi-web" class="me-2" />
        {{ event.location }}
      </p>
      <p dusk="event-dates">
        <span v-if="event.event_date">
          <v-icon icon="mdi-calendar-clock" class="me-2" />
          {{ event.event_date }}
          <template v-if="event.event_start && event.event_end">
            from {{ event.event_start }} to {{ event.event_end }}
          </template>
          <template v-else-if="event.event_start && !event.event_end">
            at {{ event.event_start }}
          </template>
          <template v-else-if="event.event_end && !event.event_start">
            until {{ event.event_end }}
          </template>
        </span>
      </p>
    </v-card-text>

    <v-card-text dusk="ticket-generation">
      Ticket generation available from {{ event.start_date_time }} UTC
      until {{ event.end_date_time }} UTC
    </v-card-text>

    <v-card-text dusk="event-owner">
      Event created/owned by {{ event.user.name }}
    </v-card-text>

    <v-card-text>
      <v-row>
        <v-col cols="12" md="6" dusk="eligible-policies">
          <v-card color="primary" class="text-center">
            <v-card-title>
              <h5>{{ event.policies.length }}</h5>
            </v-card-title>
            <v-card-subtitle>Eligible Policies</v-card-subtitle>
          </v-card>
        </v-col>
        <v-col cols="12" md="6" dusk="generated-tickets">
          <v-card color="secondary" class="text-center">
            <v-card-title>
              <h5>{{ event.tickets_count }}</h5>
            </v-card-title>
            <v-card-subtitle>Generated Tickets</v-card-subtitle>
          </v-card>
        </v-col>
      </v-row>
    </v-card-text>

    <v-card-actions>
      <v-btn color="primary" :href="route('manage-event.edit', event.uuid)" dusk="edit-event-btn">
        <v-icon icon="mdi-pencil"></v-icon>
        Edit
      </v-btn>
      <v-spacer />
      <v-btn color="secondary" :href="route('event.show', event.uuid)" target="_blank" dusk="view-public-page-btn">
        <v-icon icon="mdi-external-link"></v-icon>
        View Public Page
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

