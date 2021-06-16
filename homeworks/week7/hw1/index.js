document.querySelector('form').addEventListener('submit', (e) => {
  e.preventDefault()
  let hasError = false/* 用來判斷使否有錯誤 */
  const values = {}
  const elements = document.querySelectorAll('.required')
  /* eslint-disable no-undef */
  for (element of elements) {
    const radios = element.querySelectorAll('input[type=radio]')
    const input = element.querySelector('input[type=text]')
    let isValid = true
    if (input) {
      values[input.name] = input.value/* 為了拿到輸入的資料 */
      if (!input.value) {
        isValid = false
      }
    } else if (radios.length) {
      isValid = [...radios].some((radio) => radio.checked)
      if (isValid) {
        const r = element.querySelector('input[type=radio]:checked')/* 使用CSS選擇器來顯示 checkbox 選擇哪個選項 */
        values[r.name] = r.value
      }
    } else {
      continue/* 兩個狀況都沒有就跳掉, 不會執行下面程式 */
    }
    if (!isValid) {
      element.classList.remove('hide-error')
      hasError = true
    } else {
      element.classList.add('hide-error')
    }
  }
  if (!hasError) {
    alert(JSON.stringify(values))/* 因為內容是陣列要把他印出來 */
  }
})/* 因為按 ENTER 也需要可以改變我們要的狀態, 所以我們的目標要放在 form 上面而不是 buttom */
/* 老師用的方法是把要的東西先打在上面並隱藏起來, 觸發了條件之後再把 class 移除而造成隱藏條件消失而顯現! */
