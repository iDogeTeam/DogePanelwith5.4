import Vue from 'vue'
import Example from '@/components/Example'

describe('example.vue', () => {
  it('should render correct contents', () => {
    const Constructor = Vue.extend(Example)
    const vm = new Constructor().$mount()
    expect(vm.$el.querySelector('.panel-body').textContent)
      .to.equal('I\'m an example component!')
  })
})
