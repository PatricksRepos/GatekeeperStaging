// tests/Unit/frontend/Dashboard.spec.mjs

import { shallowMount } from '@vue/test-utils';
import Dashboard from '@/components/Dashboard.vue';  // Adjust the path based on your project structure

describe('Dashboard.vue', () => {
  let wrapper;

  beforeEach(() => {
    wrapper = shallowMount(Dashboard);
  });

  it('renders dashboard correctly', () => {
    expect(wrapper.find('h1').text()).toBe('Dashboard');
    expect(wrapper.find('.user-name').text()).toContain('Welcome');
  });

  it('displays correct event count', () => {
    const eventCount = wrapper.find('.event-count');
    expect(eventCount.exists()).toBe(true);
    expect(eventCount.text()).toBe('5 Events');
  });

  it('responds to button click', async () => {
    const button = wrapper.find('button');
    await button.trigger('click');
    // Assuming the button triggers an event or a method in the component
    expect(wrapper.emitted().clickEvent).toBeTruthy();
  });
});
