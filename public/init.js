document.addEventListener('alpine:init', () => {
  Alpine.data('ace', (config = {}) => ({
    editor: null,
    textarea: null,

    init() {
      this.textarea = this.$root.querySelector('textarea')

      this.editor = ace.edit(
        this.$root.querySelector('.ace_editor'),
        config.options ?? {}
      );

      this.editor.session.setMode(`ace/mode/${config.language ?? 'javascript'}`)

      this.setTheme()

      this.editor.session.on('change', () => this.textarea.value = this.editor.getValue())

      if (this.$el?.readonly || this.$el?.disabled) {
        this.editor.readonly()
      }

      window.addEventListener('darkMode:toggle', () => this.setTheme())

      this.textarea.addEventListener('reset', () => this.init(config))
    },

    setTheme() {
      const theme = Alpine.store('darkMode').on
        ? config.themes.dark ? `ace/theme/${config.themes.dark}` : ''
        : config.themes.light ? `ace/theme/${config.themes.light}` : ''

      this.editor.setTheme(theme)
    }
  }))
})
