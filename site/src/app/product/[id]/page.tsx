"use client";

import { useEffect, useState } from "react";
import Image from "next/image";
import { useParams } from "next/navigation";
import { IProduct } from "@/interfaces/IProduct";
import { fetchProducts } from "@/services/api/product/get";
import { addToCart } from "@/services/api/cart/post";

const PageProduct = () => {
  const params = useParams();
  const { id } = params || {};
  const [product, setProduct] = useState<IProduct>();
  const [quantity, setQuantity] = useState(1);
  const id_cliente = 3; // Hardcoded for testing; replace with dynamic client ID from auth

  useEffect(() => {
    const loadProduct = async () => {
      const products = await fetchProducts();
      const foundProduct = products.find(
        (p) => Number(p.id_produto) === Number(id)
      );
      setProduct(foundProduct);
    };
    loadProduct();
  }, [id]);

  const handleAddToCart = async () => {
    if (product) {
      const success = await addToCart(product, id_cliente, quantity);
      if (success) {
        alert("Produto adicionado ao carrinho!");
      }
    }
  };

  if (!product) {
    return <p>Produto não encontrado</p>;
  }

  return (
    <section className="w-full max-w-screen-xl mx-auto px-4">
      <div className="flex gap-4">
        <div className="relative h-100 w-100">
          <Image
            src={`http://localhost:8081/produtos/imagens/${product.imagem}`}
            alt={product.produto}
            fill
            sizes="100%"
            className="object-cover border border-gray-300"
          />
        </div>
        <div className="flex-1">
          <h1>{product.produto}</h1>
          <p>{product.marca}</p>
          <p>{product.descricao}</p>
          <span>R$ {product.preco}</span>
          <div className="flex gap-2 py-4">
            <button
              onClick={() => setQuantity((q) => (q > 1 ? q - 1 : 1))}
              className="border border-gray-300 px-2"
            >
              -
            </button>
            <span>{quantity}</span>
            <button
              onClick={() => setQuantity((q) => q + 1)}
              className="border border-gray-300 px-2"
            >
              +
            </button>
          </div>
          <button
            onClick={handleAddToCart}
            className="border border-gray-300 px-4 py-2"
          >
            Adicionar ao Carrinho
          </button>
        </div>
      </div>
    </section>
  );
};

export default PageProduct;
