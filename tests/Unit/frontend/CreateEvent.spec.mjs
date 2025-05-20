// tests/Unit/frontend/CreateEvent.spec.mjs

import { shallowMount } from '@vue/test-utils';
import CreateEvent from '@/components/CreateEvent.vue';  // Adjust the path

describe('CreateEvent.vue', () => {
  let wrapper;

  beforeEach(() => {
    wrapper = shallowMount(CreateEvent);
  });

  it('renders create event form', () => {
    expect(wrapper.find('input[name="eventName"]').exists()).toBe(true);
    expect(wrapper.find('input[name="eventLocation"]').exists()).toBe(true);
    expect(wrapper.find('button[type="submit"]').text()).toBe('Create Event');
  });

  it('validates form inputs', async () => {
    await wrapper.find('input[name="eventName"]').setValue('');
    await wrapper.find('form').trigger('submit.prevent');
    expect(wrapper.text()).toContain('Event name is required');
  });

  it('submits form when valid', async () => {
    await wrapper.find('input[name="eventName"]').setValue('New Event');
    await wrapper.find('input[name="eventLocation"]').setValue('Online');
    await wrapper.find('form').trigger('submit.prevent');
    expect(wrapper.emitted().submit).toBeTruthy();
  });
});
