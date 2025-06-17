<script setup>
import {debounce} from 'lodash-es';;

const {$ckeditor} = useNuxtApp()
const editor = $ckeditor.customEditor;
const props = defineProps({
  initialText: {
    type: String,
    required: false,
    default: ''
  },
  getOutputText: {
    type: Function,
    required: true
  },
})
const textOutput = ref('')

const statistics = reactive({
  words: 0,
  chars: 0
})

const editorConfig = {
  plugins: [
    'Alignment',
    'AutoImage',
    'Autoformat',
    'BlockQuote',
    'Bold',
    'Code',
    'CodeBlock',
    'Essentials',
    'FontBackgroundColor',
    'FontColor',
    'FontFamily',
    'FontSize',
    'Heading',
    'Highlight',
    'HorizontalLine',
    'Image',
    'ImageCaption',
    'ImageInsert',
    'ImageResize',
    'ImageStyle',
    'ImageToolbar',
    'ImageUpload',
    'Italic',
    'Indent',
    'IndentBlock',
    'Link',
    'List',
    'ListStyle',
    'MathType',
    'PageBreak',
    'Paragraph',
    'PasteFromOffice',
    'RemoveFormat',
    'SpecialCharacters',
    'SpecialCharactersArrows',
    'SpecialCharactersCurrency',
    'SpecialCharactersLatin',
    'SpecialCharactersMathematical',
    'SpecialCharactersText',
    'Strikethrough',
    'Subscript',
    'Superscript',
    'Table',
    'TableCellProperties',
    'TableProperties',
    'TableToolbar',
    'TextTransformation',
    'TodoList',
    'Underline',
    'WordCount'
  ],
  toolbar: {
    items: [
      'undo',
      'redo',
      'bold',
      'italic',
      'underline',
      'heading',
      'alignment',
      'fontColor',
      'fontBackgroundColor',
      'fontFamily',
      'fontSize',
      'link',
      'MathType',
      'ChemType',
      'SpecialCharacters',
      'subscript',
      'superscript',
      'insertImage',
    ],
  },
  wordCount: {
    onUpdate: stats => {
      statistics.words = stats.words
      statistics.chars = stats.characters
    }
  }
}


onMounted(() => textOutput.value = props.initialText)

watch(textOutput, debounce(() => props.getOutputText(textOutput.value), 350))
const resetContent = text => textOutput.value = text

const nuxtApp = useNuxtApp()
if (!nuxtApp.$cleanCkeditor) {
  nuxtApp.provide('cleanCkeditor', resetContent)
}
</script>
<template>
  <ClientOnly>
    <ckeditor :editor="editor" v-model="textOutput" :config="editorConfig"/>
    <div class="d-flex align-items-center flex-row-reverse mt-1" style="font-size: 12px">
      Sözlər: {{ statistics.words }}, Simvollar: {{ statistics.chars }} <br>
    </div>
  </ClientOnly>
</template>
